<?php
require_once 'Model.php';
			
class ModelService extends Model {
			   
    protected static $object = 'Service';
    protected static $primary= 'idService';
    protected static $name= 'motClef';

    private $idService;
    private $description;
    private $tarif;
    private $motClef;
    private $estValide;
    private $idProprio;
    
    public function getIdService() {
        return $this->idService;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getTarif() {
        return $this->tarif;
    }

    public function getMotClef() {
        return $this->motClef;
    }

    public function getEstValide() {
        return $this->estValide;
    }

    public function getIdProprio() {
        return $this->idProprio;
    }

    public function setIdService($idService) {
        $this->idService = $idService;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setTarif($tarif) {
        $this->tarif = $tarif;
    }

    public function setMotClef($motClef) {
        $this->motClef = $motClef;
    }

    public function setEstValide($estValide) {
        $this->estValide = $estValide;
    }

    public function setIdProprio($idProprio) {
        $this->idProprio = $idProprio;
    }

    public function __construct ($description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $idProprio = NULL){
        if(!is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($idProprio) ) 
        {
            $this->description = $description;
            $this->tarif = $tarif;
            $this->motClef = $motClef;
            $this->estValide = $estValide;
            $this->idProprio = $idProprio;
        }
    }

    /*public static function compresserDispos($valeurs, $jours){
        $chaine = "";

        $i = 0;

        foreach ($valeurs as $key=>$value) {
            if ($i % 2 == 0){
                $chaine.=$jours[$key]." : De ".$value;
                $i+= 1;
            }
            else{
                $chaine.="h à ".$value."h\n";
                $i+= 1;
            }
        }
        return $chaine;
    }*/
    
    public function deleteService(){
        ModelService::supprimerSeFaitSur($this->idService);
        ModelService::supprimerCreneaux($this->idService);
        $this->delete($this->idService);
    }
    
    public function updateIdService(){
        $id = Model::$pdo->lastInsertId();
        $this->setIdService($id);
        return $id; // id correspond à l'attribut qu'on séléctionne dans la requête
    }
    
    public function assemblerDispo(){
        $chaine = "";
        $tab_creneaux = ModelSeFaitSur::selectCreneaux($this->idService);
        foreach($tab_creneaux as $t){ 
            $c = ModelCreneau::select($t['idCreneau']);
            $heureDebut = $c->getHeureDebut();
            $heureFin = $c->getHeureFin();
            $nomJour = $c->getNomJour();
            $ligne = $nomJour." : De ".$heureDebut."H à ".$heureFin."H";
            $chaine.=$ligne."\n";
        }
        
        return $chaine;
    }
    
    public function getJoursDispo(){
       $tab = array();
       $tab_creneaux = ModelSeFaitSur::selectCreneaux($this->idService);
       foreach($tab_creneaux as $t){ 
           $c = ModelCreneau::select($t['idCreneau']);
           $nomJour = $c->getNomJour();
           array_push($tab, $nomJour);
        }
        
        return $tab;
    }
    
    public function getNbHeuresByJour($jour){
       $tab_creneaux = ModelSeFaitSur::selectCreneaux($this->idService);
       foreach($tab_creneaux as $t){ 
           $c = ModelCreneau::select($t['idCreneau']);
           $nomJour = $c->getNomJour();
           if ($nomJour === $jour){
               $heureDeb = $c->getHeureDebut();
               $heureFin = $c->getHeureFin();
               return $heureFin-$heureDeb;
           }
        }
    }
   
    
    public static function supprimerCreneaux($idService){
        $tab_creneaux = ModelSeFaitSur::selectCreneaux($idService);
        foreach($tab_creneaux as $t){
            $idCreneau = $t['idCreneau'];
            ModelCreneau::delete($idCreneau);
        }
    }
    
    public static function supprimerSeFaitSur($idService){
        $tab_creneaux = ModelSeFaitSur::selectCreneaux($idService);
        foreach($tab_creneaux as $t){
            $idService = $t['idService'];
            ModelSeFaitSur::delete($idService);
        }
    }

    public function updateNewCreneaux($valeurs, $jours){
        // Pour mettre à jour les créneaux, on supprime les anciennes relations et les anciens créneaux puis ont recrée des créneaux et des relations avec les nouvelles valeurs
        
        ModelService::supprimerSeFaitSur($this->idService);
        ModelService::supprimerCreneaux($this->idService);
        
        $listeIDC=ModelCreneau::creerCreneaux($valeurs, $jours);
        ModelSeFaitSur::creerRelations($this->idService, $listeIDC);

    }

    public static function validate($idService){ 
        $sql = "UPDATE Service SET estValide = 1 WHERE idService=:id_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "id_tag" => $idService
        );
        $req_prep->execute($values);
    }


    public static function desactiver($idService){ 
        $sql = "UPDATE Service SET estValide = 0 WHERE idService=:id_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "id_tag" => $idService,
        );
        $req_prep->execute($values);

    }
    
    public static function rechercheByPrixAvecVille($prix1, $prix2, $name, $ville) {
                    $name_element = static::$name;
                try {
                    $sql = "SELECT * from Service INNER JOIN membre ON service.idProprio = membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "prix1" => $prix1,
                        "prix2" => $prix2,
                        "name_element" => '%'.$name.'%',
                        "ville_tag" => $ville
                    );
                    $req_prep->execute($values);

                    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelService');
                    $tab= $req_prep->fetchAll();

                    if (empty($tab)){
                        return false;
                    }
                    else return $tab;

                } catch (PDOException $e) {
                    if (Conf::isDebug()) {
                        echo $e->getMessage();
                    } else {
                    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
                }
                die();
                    }   
                }
                
                public static function rechercheByPrix($prix1, $prix2, $name) {
                    $name_element = static::$name;
                try {
                    $sql = "SELECT * from Service WHERE ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "prix1" => $prix1,
                        "prix2" => $prix2,
                        "name_element" => '%'.$name.'%',
                    );
                    $req_prep->execute($values);

                    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelService');
                    $tab= $req_prep->fetchAll();

                    if (empty($tab)){
                        return false;
                    }
                    else return $tab;

                } catch (PDOException $e) {
                    if (Conf::isDebug()) {
                        echo $e->getMessage();
                    } else {
                    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
                }
                die();
                    }   
                }
                
                public static function rechercheAvecVille($name,$ville) {

                    $name_element = static::$name;

                    try {
                        $sql = "SELECT * from Service INNER JOIN membre ON service.idProprio = membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element";
                        $req_prep = Model::$pdo->prepare($sql);
                        $values = array(
                        "name_element" => '%'.$name.'%',
                        "ville_tag" => $ville
                        );
                        $req_prep->execute($values);

                        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelService');
                        $tab= $req_prep->fetchAll();

                        if (empty($tab)){
                            return false;
                        }
                        return $tab;
                    } catch (PDOException $e) {
                        if (Conf::isDebug()) {
                        echo $e->getMessage();
                        } else {
                            echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
                        }
                    die();
                }
            }
            
             public static function deleteAllServicesbyMembre($idMembre){
                 $tab_s = ModelService::selectAll();
                 foreach($tab_s as $s){
                    if($s->getIdProprio() == $idMembre){
                        $s->deleteService();
                    }
                 }
             }
}
?>
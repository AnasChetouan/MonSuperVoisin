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
    private $disponibilites;
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

    public function getDisponibilites() {
        return $this->disponibilites;
    }

    public function getIdProprio() {
        return $this->idProprio;
    }

    public function setDisponibilites($disponibilites) {
        $this->disponibilites = $disponibilites;
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

    public function __construct ($description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $disponibilites = NULL, $idProprio = NULL){
        if(!is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($disponibilites) && !is_null($idProprio) ) 
        {
            $this->description = $description;
            $this->tarif = $tarif;
            $this->motClef = $motClef;
            $this->estValide = $estValide;
            $this->disponibilites = $disponibilites;
            $this->idProprio = $idProprio;
        }
    }

    public static function compresserDispos($valeurs, $jours){
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
    }

    public static function validate($idService){ 
        $sql = "UPDATE Bien SET estValide = 1 WHERE idService=:id_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "id_tag" => $idService,
        );
        $req_prep->execute($values);
    }


    public static function desactiver($idService){ 
        $sql = "UPDATE Bien SET estValide = 0 WHERE idService=:id_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "id_tag" => $idService,
        );
        $req_prep->execute($values);

    }
    
    public static function rechercheByPrixAvecVille($prix1, $prix2, $name, $ville) {
                    $name_element = static::$name;
                try {
                    $sql = "SELECT * from service INNER JOIN membre ON service.idProprio = membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
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
                    $sql = "SELECT * from service WHERE ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
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
                        $sql = "SELECT * from service INNER JOIN membre ON service.idProprio = membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element";
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

}

                        
?>
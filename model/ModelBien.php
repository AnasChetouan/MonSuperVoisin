<?php
	require_once 'Model.php';
	class ModelBien extends Model {
		protected static $object = 'Bien';
		protected static $primary = 'idBien';
		protected static $name = 'titre';
        
		// ATTRIBUTS
                
                private $idBien;
                private $titre;
                private $description;
                private $tarif;
                private $motClef;
                private $estValide;
                private $lienPhoto;
                private $prixNeuf;
                private $idProprio;

		// ACCESSEURS EN ECRITURE/LECTURE
                public function getIdBien() {
                    return $this->idBien;
                }
                public function getTitre() {
                    return $this->titre;
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
                public function getLienPhoto() {
                    return $this->lienPhoto;
                }
                public function getPrixNeuf() {
                    return $this->prixNeuf;
                }
                
                public function getIdProprio() {
                    return $this->idProprio;
                }
                public function setIdBien($idBien) {
                    $this->idBien = $idBien;
                }
                public function setTitre($titre) {
                    $this->titre = $titre;
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
                public function setLienPhoto($lienPhoto) {
                    $this->lienPhoto = $lienPhoto;
                }
                public function setPrixNeuf($prixNeuf) {
                    $this->prixNeuf = $prixNeuf;
                }
                public function setIdProprio($idProprio) {
                    $this->idProprio = $idProprio;
                }
                                
		// CONSTRUCTEUR(S)
                
                public function __construct ($titre = NULL, $description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $lienPhoto = NULL, $prixNeuf = NULL, $idProprio = NULL)
		{
                    if(!is_null($titre) && !is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($lienPhoto) && !is_null($prixNeuf) && !is_null($idProprio))
                        {
                            $this->titre = $titre;
                            $this->description = $description;
                            $this->tarif = $tarif;
                            $this->motClef = $motClef;
                            $this->estValide = $estValide;
                            $this->lienPhoto = $lienPhoto;
                            $this->prixNeuf = $prixNeuf;
                            $this->idProprio = $idProprio;
                        }
                }

        // METHODES
                
                   public function updateLienPhoto($extension){
                     $req = Model::$pdo->query("SELECT idBien FROM Bien WHERE lienPhoto = 'temp'");
                     while($listeId = $req->fetch()){
                         $sql = "UPDATE Bien SET lienPhoto =:new_lien WHERE idBien=:id_p";
                         $req_prep = Model::$pdo->prepare($sql);
                         $values = array(
                           "id_p" => $listeId['idBien'],
                           "new_lien" => "uploads/".$listeId['idBien'].".".$extension,
                        );
                        $req_prep->execute($values);
                     }
                     return $values["new_lien"];
                }
                
                public function getReservations(){
                    $rep = Model::$pdo->query("SELECT * FROM Emprunt WHERE idProduit=".$this->idBien." AND estBien = 1;");
                    $tab = $rep->fetchAll();
                   
                    return $tab;
                }
		
		/*public static function pasDispo($idB){ 
                $sql = "UPDATE Bien SET estDispo = 0 WHERE idBien=:idB_tag";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "idB_tag" => $idB,
                );
                $req_prep->execute($values);
                }
                
                public static function updateDispo(){
                 $login = "";
                 $sql = "UPDATE Bien B SET estDispo = 1 WHERE NOT EXISTS( SELECT * FROM Emprunt WHERE idBien = B.idBien )";
                 $req_prep = Model::$pdo->prepare($sql);
                 $values = array(
                    "login_tag" => $login,
                 );
                 $req_prep->execute($values);
                }*/
                
                public static function validate($idBien){ 
                $sql = "UPDATE Bien SET estValide = 1 WHERE idBien=:id_tag";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                "id_tag" => $idBien,
                );
                $req_prep->execute($values);
                }
    
                public static function desactiver($idBien){ 
                $sql = "UPDATE Bien SET estValide = 0 WHERE idBien=:id_tag";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                "id_tag" => $idBien,
                );
                $req_prep->execute($values);
                }
                
                public static function rechercheByPrixAvecVille($prix1, $prix2, $name, $ville) {
                    $name_element = static::$name;
                try {
                    $sql = "SELECT * from Bien INNER JOIN Membre ON Bien.idProprio = Membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "prix1" => $prix1,
                        "prix2" => $prix2,
                        "name_element" => '%'.$name.'%',
                        "ville_tag" => $ville
                    );
                    $req_prep->execute($values);

                    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBien');
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
                    $sql = "SELECT * from Bien WHERE ".$name_element." LIKE :name_element AND tarif BETWEEN :prix1 AND :prix2";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "prix1" => $prix1,
                        "prix2" => $prix2,
                        "name_element" => '%'.$name.'%',
                    );
                    $req_prep->execute($values);

                    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBien');
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
                        $sql = "SELECT * from Bien INNER JOIN Membre ON Bien.idProprio = Membre.idMembre AND ville=:ville_tag AND ".$name_element." LIKE :name_element";
                        $req_prep = Model::$pdo->prepare($sql);
                        $values = array(
                        "name_element" => '%'.$name.'%',
                        "ville_tag" => $ville
                        );
                        $req_prep->execute($values);

                        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBien');
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
            
            public static function deleteAllBiensbyMembre($idMembre){
                    $sql = "DELETE FROM Bien WHERE idProprio =:idMembre_tag  ";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "idMembre_tag" => $idMembre
                    );
                    $req_prep->execute($values); 
                }
                
                
                
                
        }
 ?>

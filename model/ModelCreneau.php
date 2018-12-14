<?php
require_once 'Model.php';
			
class ModelCreneau extends Model {
			   
    protected static $object = 'Creneau';
    protected static $primary= 'idCreneau';

    private $idCreneau;
    private $nomJour;
    private $heureDebut;
    private $heureFin;
    
    public static function getObject() {
        return self::$object;
    }

    public static function getPrimary() {
        return self::$primary;
    }
    
    public function getIdCreneau() {
        return $this->idCreneau;
    }

    public function setIdCreneau($idCreneau) {
        $this->idCreneau = $idCreneau;
    }
 
    public function getNomJour() {
        return $this->nomJour;
    }

    public function getHeureDebut() {
        return $this->heureDebut;
    }

    public function getHeureFin() {
        return $this->heureFin;
    }

    public static function setObject($object) {
        self::$object = $object;
    }

    public static function setPrimary($primary) {
        self::$primary = $primary;
    }

    public function setNomJour($nomJour) {
        $this->nomJour = $nomJour;
    }

    public function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;
    }

    public function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;
    }

     

    public function __construct ($nomJour = NULL, $heureDebut = NULL, $heureFin = NULL){
        if(!is_null($nomJour) && !is_null($heureDebut) && !is_null($heureFin)) 
        {
            $this->nomJour = $nomJour;
            $this->heureDebut = $heureDebut;
            $this->heureFin = $heureFin;
        }
    }
    
    public function updateIdCreneau(){
        $id = Model::$pdo->lastInsertId();
        $this->setIdCreneau($id);
        return $id; // id correspond à l'attribut qu'on séléctionne dans la requête
    }
    
    public static function creerCreneaux($valeurs, $jours){
        $idCreneaux = array();
        for($i = 0; $i < sizeof($valeurs);$i+=2) // aurait pu marcher avec sizeof($jours) car même taille
        {
            $heureDebut=$valeurs[$i];
            $heureFin=$valeurs[$i+1];
            $nomJour=$jours[$i];
            $c = new ModelCreneau($nomJour, $heureDebut, $heureFin);
            $c->save();
            array_push($idCreneaux, $c->updateIdCreneau());
        }
        return $idCreneaux;
    }
    
}
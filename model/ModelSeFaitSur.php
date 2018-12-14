<?php
require_once 'Model.php';
			
class ModelSeFaitSur extends Model {
			   
    protected static $object = 'SeFaitSur';
    protected static $primary= 'idService';

    private $idService;
    private $idCreneau;
    
    public static function getObject() {
        return self::$object;
    }

    public static function getPrimary() {
        return self::$primary;
    }

    public static function setObject($object) {
        self::$object = $object;
    }

    public static function setPrimary($primary) {
        self::$primary = $primary;
    }
        
    public function getIdService() {
        return $this->idService;
    }

    public function getIdCreneau() {
        return $this->idCreneau;
    }

    public function setIdService($idService) {
        $this->idService = $idService;
    }

    public function setIdCreneau($idCreneau) {
        $this->idCreneau = $idCreneau;
    }

    public function __construct ($idService = NULL, $idCreneau = NULL){
        if(!is_null($idService) && !is_null($idCreneau)) 
        {
            $this->idService = $idService;
            $this->idCreneau = $idCreneau;
        }
    }
    
    public static function creerRelations($idS, $listeIDC){
        foreach ($listeIDC as $key => $value){
            $idC=$value;
            $rel = new ModelSeFaitSur($idS, $idC);
            $rel->save();
        }
    }
    
    public static function selectCreneaux($idService) {
        $rep = Model::$pdo->query("SELECT * FROM SeFaitSur WHERE idService=".$idService.";");
        $tab = $rep->fetchAll();
        return $tab;
    }
    
      
    
}
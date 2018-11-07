<?php
require_once 'Model.php';
			
class ModelService extends Proposition {
			   
    protected static $object = 'Service';
    protected static $primary='idService';
    protected static $name='motClef';

    private $idService;
    private $dateDebut;
    private $dateFin;
    private $dispo;

    public function getIdService() {
        return $this->idService;
    }

    public function setIdService($idService) {
        $this->idService = $idService;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;

    }

    public function getDispo() {
        return $this->dispo;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function setDispo($dispo) {
        $this->dispo = $dispo;
    }


    public function __construct ($titre = NULL, $description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $dateDebut = NULL, $dateFin = NULL, $dispo = NULL){
        if(!is_null($titre) && !is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($dateDebut) && !is_null($dateFin) && !is_null($dispo) ) 
        {
            parent::__construct($titre, $description, $tarif, $motClef, $estValide);
            $this->dateDebut = $dateDebut;
            $this->dateFin = $dateFin;
            $this->dispo = $dispo;
        }
    }
                           
}                 
                        
?>
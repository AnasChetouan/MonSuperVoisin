<?php
require_once 'Model.php';
			
class ModelService extends Model {
			   
    protected static $object = 'Service';
    protected static $primary='idService';
    protected static $name='motClef';

    private $idService;
    private $titre;
    private $description;
    private $tarif;
    private $motClef;
    private $estValide;
    private $dateDebut;
    private $dateFin;
    private $dispo;
    
    public function getIdService() {
        return $this->idService;
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

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function getDispo() {
        return $this->dispo;
    }

    public function setIdService($idService) {
        $this->idService = $idService;
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
  
            $this->titre = $titre;
            $this->description = $description;
            $this->tarif = $tarif;
            $this->motClef = $motClef;
            $this->estValide = $estValide;
            $this->dateDebut = $dateDebut;
            $this->dateFin = $dateFin;
            $this->dispo = $dispo;
        }
    }
                           
}                 
                        
?>
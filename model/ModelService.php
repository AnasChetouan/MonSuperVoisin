<?php
			require_once 'Model.php';
			
			class ModelService extends Model {
			   
                            
                         protected static $object = 'Service';
  			 protected static $primary='idService';
  			 protected static $name='motClef';
                         
                           private $idService;
                           private $description;
                           private $motClef;
                           private $tarif;
                           private $dateDebut;
                           private $dateFin;
                           private $plageHoraire;
                           private $estValide;
                           
                           public function getIdService(){
                               return $this->idService;
                           }
                         
                           public function getDescription(){
                               return $this->description;
                           }
                           
                           public function getMotClef(){
                               return $this->motClef;
                           }
                           
                           public function getTarif(){
                               return $this->tarif;
                           }
                           
                           public function getDateDebut(){
                               return $this->dateDebut;
                           }
                           
                           public function getDateFin(){
                               return $this->dateFin;
                           }
                           
                           public function getPlageHoraire(){
                               return $this->plageHoraire;
                           }
                           
                           public function getEstValide(){
                               return $this->estValide;
                           }
                           
                           public function setIdService($idService){
                               $this->idService = $idService;
                           }
                         
                           public function setDescription($description){
                               $this->description = $description;
                           }
                           
                           public function setMotClef($motClef){
                               $this->motClef = $motClef;
                           }
                           
                           public function setTarif($tarif){
                               $this->tarif = $tarif;
                           }
                           
                           public function setDateDebut($dateDebut){
                               $this->dateDebut = $dateDebut;
                           }
                           
                           public function setDateFin($dateFin){
                               $this->dateFin = $dateFin;
                           }
                           
                           public function setPlageHoraire($plageHoraire){
                               $this->plageHoraire = $plageHoraire;
                           }
                           
                           public function setEstValide($estValide){
                               $this->estValide = $estValide;
                           }
                           
                           public function __construct($estValide = NULL,$description = NULL,$plageHoraire = NULL, $motClef = NULL, $tarif = NULL, $dateDebut = NULL, $dateFin = NULL) {
				  if (!is_null($description) && !is_null($plageHoraire) && !is_null($motClef) && !isnull($estValide) && !is_null($tarif) && !is_null($dateDebut) && !is_null($dateFin) ) {
					
					$this->description= $description;
					$this->tarif = $tarif;
					$this->dateDebut = $dateDebut;
					$this->dateFin = $dateFin;
					$this->plageHoraire = $plageHoraire;
                                        $this->estValide = $estValide;
					}
			  }	
                           
                        }
                        

                        
                        
?>
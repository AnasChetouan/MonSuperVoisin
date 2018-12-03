
<?php
	require_once "Model.php";
			
	class ModelEmprunt extends Model{
		protected static $object = "Emprunt";
		protected static $primary= 'idEmprunt';
    
		private $idEmprunt;
		private $idProposant;
		private $idAcceptant;
		private $idProduit;
		private $estBien;
                private $dateDebut;
                private $dateFin;
                
		///////////////////////////////////////////////
		/////////////////GETTER et SETTER////////////// 
		///////////////////////////////////////////////   
			   
	
                function getIdEmprunt() {
                    return $this->idEmprunt;
                }

                function getIdProposant() {
                    return $this->idProposant;
                }

                function getIdAcceptant() {
                    return $this->idAcceptant;
                }

                function getIdProduit() {
                    return $this->idProduit;
                }

                function getEstBien() {
                    return $this->estBien;
                }

                function getDateDebut() {
                    return $this->dateDebut;
                }

                function getDateFin() {
                    return $this->dateFin;
                }

                function setIdEmprunt($idEmprunt) {
                    $this->idEmprunt = $idEmprunt;
                }

                function setIdProposant($idProposant) {
                    $this->idProposant = $idProposant;
                }

                function setIdAcceptant($idAcceptant) {
                    $this->idAcceptant = $idAcceptant;
                }

                function setIdProduit($idProduit) {
                    $this->idProduit = $idProduit;
                }

                function setEstBien($estBien) {
                    $this->estBien = $estBien;
                }

                function setDateDebut($dateDebut) {
                    $this->dateDebut = $dateDebut;
                }

                function setDateFin($dateFin) {
                    $this->dateFin = $dateFin;
                }

                
                
                public function __construct($idP = NULL,$idA= NULL,$idPt= NULL,$estB= NULL,$dD= NULL,$dF= NULL) {
				  if (!is_null($idP) && !is_null($idA) && !is_null($idPt) && !is_null($estB) && !is_null($dD) && !is_null($dF)) {
                                    $this->idProposant = $idP;
                                    $this->idAcceptant = $idA;
                                    $this->idProduit = $idPt;
                                    $this->estBien = $estB;
                                    $this->dateDebut = $dD;
                                    $this->dateFin = $dF;
					}
			  }
        
        
        
    }
?>
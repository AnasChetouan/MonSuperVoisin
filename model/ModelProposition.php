<?php

	require_once 'Model.php';

	class ModelProposition extends Model {
		protected static $object = 'Proposition';
		protected static $primary = 'idProposition';
		protected static $name = 'nom';

		// ATTRIBUTS

		private $idProposition;
		private $titre;
		private $description;
		private $tarif;
		private $motClef;
		private $estValide;

		// ACCESSEURS EN ECRITURE/LECTURE
                
                

		public function getIdProposition() {
			return $idProposition;
		}

		public function setIdProposition($idProposition) {
			$this->idProposition = $idProposition;
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

                
		// METHODES

		// CONSTRUCTEUR(S)
                
                public function __construct ($titre = NULL, $description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL)
		{
                    if(!is_null($titre) && !is_null($description) && !is_null($tarif)
                            && !is_null($motClef) && !is_null($estValide)){
                        
                        $this->titre=$titre;
                        $this->description = $description;
			$this->prenom = $tarif;
			$this->motClef = $motClef;
			$this->estValide = $estValide;
                        }
                    
		}
}

 ?>
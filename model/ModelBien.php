<?php

	require_once 'Model.php';

	class ModelBien extends Model {
		protected static $object = 'Bien';
		protected static $primary = 'idBien';
		protected static $name = 'nom';

		// ATTRIBUTS
                
                private $idBien;
                private $lienPhoto;
                private $prixNeuf;
                private $estDispo;

		// ACCESSEURS EN ECRITURE/LECTURE
                
                public function getIdBien() {
                    return $this->idBien;
                }

                public function setIdBien($idBien) {
                    $this->idBien = $idBien;
                }
                   
                public function getLienPhoto() {
                    return $this->lienPhoto;
                }

                public function getPrixNeuf() {
                    return $this->prixNeuf;
                }

                public function getEstDispo() {
                    return $this->estDispo;
                }

                public function setLienPhoto($lienPhoto) {
                    $this->lienPhoto = $lienPhoto;
                }

                public function setPrixNeuf($prixNeuf) {
                    $this->prixNeuf = $prixNeuf;
                }

                public function setEstDispo($estDispo) {
                    $this->estDispo = $estDispo;
                }

                
		// METHODES

		// CONSTRUCTEUR(S)
                
                public function __construct ($titre = NULL, $description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $lienPhoto = NULL, $prixNeuf = NULL, $estDispo = NULL)
		{
                    if(!is_null($titre) && !is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($lienPhoto) && !is_null($prixNeuf) && !is_null($estDispo))
                        {
                            parent::__construct($titre, $description, $tarif, $motClef, $estValide);
                            $this->lienPhoto = $lienPhoto;
                            $this->prixNeuf = $prixNeuf;
                            $this->estDispo = $estDispo;
                        }
                }
        }

 ?>
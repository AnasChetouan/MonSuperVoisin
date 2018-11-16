<?php

	require_once 'Model.php';

	class ModelBien extends Model {
		protected static $object = 'Bien';
		protected static $primary = 'idBien';
		protected static $name = 'nom';

		// ATTRIBUTS
                
                private $idBien;
                private $titre;
                private $description;
                private $tarif;
                private $motClef;
                private $estValide;
                private $lienPhoto;
                private $prixNeuf;
                private $estDispo;

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

                public function getEstDispo() {
                    return $this->estDispo;
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

                public function setEstDispo($estDispo) {
                    $this->estDispo = $estDispo;
                }

                                
		// METHODES

		// CONSTRUCTEUR(S)
                
                public function __construct ($titre = NULL, $description = NULL, $tarif = NULL, $motClef = NULL, $estValide = NULL, $lienPhoto = NULL, $prixNeuf = NULL, $estDispo = NULL)
		{
                    if(!is_null($titre) && !is_null($description) && !is_null($tarif) && !is_null($motClef) && !is_null($estValide) && !is_null($lienPhoto) && !is_null($prixNeuf) && !is_null($estDispo))
                        {
                            $this->titre = $titre;
                            $this->description = $description;
                            $this->tarif = $tarif;
                            $this->motClef = $motClef;
                            $this->estValide = $estValide;
                            $this->lienPhoto = $lienPhoto;
                            $this->prixNeuf = $prixNeuf;
                            $this->estDispo = $estDispo;
                        }
                }
        }

 ?>
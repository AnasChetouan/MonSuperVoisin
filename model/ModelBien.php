<?php

	require_once 'Model.php';

	class ModelBien extends Model {
		protected static $object = 'Bien';
		protected static $primary = 'idBien';
		protected static $name = 'nom';

		// ATTRIBUTS

		private $idBien;
		private $nom;
		private $prixNeuf;
		private $lienPhoto;
		private $estValide;
		private $motClef;
		private $estDispo;

		// ACCESSEURS EN ECRITURE/LECTURE

		public function getIdBien() {
			return $idBien;
		}

		public function setIdBien($idBien) {
			$this->idBien = $idBien;
		}

		public function getNom() {
			return $nom;
		}

		public function setNom($nom) {
			$this->nom = $nom;
		}

		public function getPrixNeuf() {
			return $prixNeuf;
		}

		public function setPrixNeuf($prixNeuf) {
			$this->prixNeuf = $prixNeuf;
		}

		public function getLienPhoto() {
			return $lienPhoto;
		}

		public function setLienPhoto($lienPhoto) {
			$this->lienPhoto = $lienPhoto;
		}
		public function getEstValide() {
			return $estValide;
		}

		public function setEstValide($estValide) {
			$this->estValide = $estValide;
		}

		public function getMotClef() {
			return $motClef;
		}

		public function setMotClef($motClef) {
			$this->motClef = $motClef;
		}

		// METHODES

		// CONSTRUCTEUR(S)

		public function __construct ($nom, $prixNeuf, $lienPhoto, $estValide, $motClef, $estDispo){
			$this->nom = $nom;
			$this->prixNeuf = $prixNeuf;
			$this->lienPhoto = $lienPhoto;
			$this->estValide = $estValide;
			$this->motClef = $motClef;
			$this->estDispo = $estDispo;

		}

}

 ?>
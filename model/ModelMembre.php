<?php

	require_once 'Model.php';

	class ModelMembre extends Model {
		protected static $object = 'Membre';
		protected static $primary = 'login';
		protected static $name = 'nom';

		// ATTRIBUTS

		private $idMembre;
        private $login;
		private $nom;
		private $prenom;
		private $adresse;
		private $mail;
		private $mdp;
		private $ville;
		private $telephone;
		private $note;
		private $admin;
		private $nbConso;
		private $nbPropo;
		private $codePostal;
		private $dateInscription;
		private $solde;
                private $nonce;

		// ACCESSEURS EN ECRITURE/LECTURE

		public function getIdMembre() {
			return $this->idMembre;
		}

		public function setIdMembre($idMembre) {
			$this->idMembre = $idMembre;
		}
                
                
                public function getLogin(){
                        return $this->login;
                }
    
                public function setLogin($login){
                        $this->login = $login;
                }

		public function getNom() {
			return $this->nom;
		}

		public function setNom($nom) {
			$this->nom = $nom;
		}

		public function getPrenom() {
			return $this->prenom;
		}

		public function setPrenom($prenom) {
			$this->prenom = $prenom;
		}

		public function getAdresse() {
			return $this->adresse;
		}

		public function setAdresse($adresse) {
			$this->adresse = $adresse;
		}

		public function getMail() {
			return $this->mail;
		}

		public function setMail($mail) {
			$this->mail = $mail;
		}

		public function getMdp() {
			return $this->mdp;
		}

		public function setMdp($mdp) {
			$this->mdp = $mdp;
		}

		public function getVille() {
			return $this->ville;
		}

		public function setVille($ville) {
			$this->ville = $ville;
		}

		public function getTelephone() {
			return $this->telephone;
		}

		public function setTelephone($telephone) {
			$this->telephone = $telephone;
		}

		public function getNote() {
			return $this->note;
		}

		public function setNote($note) {
			$this->note = $note;
		}

		public function getAdmin() {
			return $this->admin;
		}

		public function setAdmin($admin) {
			$this->admin = $admin;
		}

		public function getNbConso() {
			return $this->nbConso;
		}

		public function setNbConso($nbConso) {
			$this->nbConso = $nbConso;
		}

		public function getNbPropo() {
			return $this->nbPropo;
		}

		public function setNbPropo($nbPropo) {
			$this->nbPropo = $nbPropo;
		}

		public function getCodePostal() {
			return $this->codePostal;
		}

		public function setCodePostal($codePostal) {
			$this->codePostal = $codePostal;
		}

		public function getDateInscription() {
			return $this->dateInscription;
		}

		public function setDateInscription($dateInscription) {
			$this->dateInscription = $dateInscription;
		}

		public function getSolde() {
			return $this->solde;
		}

		public function setSolde($nonce) {
			$this->nonce = $nonce;
		}
                public function getNonce() {
			return $this->nonce;
		}

		public function setNonce($solde) {
			$this->solde = $solde;
		}


		// METHODES

		// CONSTRUCTEUR(S)

		public function __construct ($login = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL, 
                        $mail = NULL, $mdp = NULL, $ville = NULL, $telephone = NULL, $note = NULL, $admin = NULL,
                        $nbConso = NULL, $nbPropo = NULL, $codePostal = NULL, $dateInscription = NULL,
                        $solde = NULL, $nonce = NULL)
		{
                    if(!is_null($login) && !is_null($nom) && !is_null($prenom)
                            && !is_null($adresse) && !is_null($mail)
                            && !is_null($mdp) && !is_null($ville) && !is_null($telephone)
                            && !is_null($note) && !is_null($admin) && !is_null($nbConso)
                            && !is_null($nbPropo) && !is_null($codePostal)
                            && !is_null($dateInscription) && !is_null($solde)
                            && !is_null($nonce)){
                        
                        $this->login=$login;
                        $this->nom = $nom;
			$this->prenom = $prenom;
			$this->adresse = $adresse;
			$this->mail = $mail;
			$this->mdp = $mdp;
			$this->ville = $ville;
			$this->telephone = $telephone;
			$this->note = $note;
			$this->admin = $admin;
			$this->nbConso = $nbConso;
			$this->nbPropo = $nbPropo;
			$this->codePostal = $codePostal;
			$this->dateInscription = $dateInscription;
			$this->solde = $solde;
                        $this->nonce = $nonce;
                            }
                        
		}
                
                 public static function checkPassword($login,$mot_de_passe_chiffre){
            $sql = "SELECT login,mdp from Membre WHERE login=:login_tag AND mdp=:mdp_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login_tag" => $login,
                "mdp_tag" => $mot_de_passe_chiffre
                         );
            $req_prep->execute($values); // problème à cette ligne lorsqu'on essaye de se connecter
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelMembre');
            $tab= $req_prep->fetchAll();

            if (empty($tab)){
                return false;
            }
            return true;
    }
    //la fonction suivante retourne vrai si l'utilisateur avec le login et le mdp ecrit en parametre est un admin, faux sinon
    public static function adminOrNot($login,$mot_de_passe_chiffre){ 
        $sql = "SELECT admin from Membre WHERE login=:login_tag AND mdp=:mdp_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login_tag" => $login,
                "mdp_tag" => $mot_de_passe_chiffre
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelMembre');
            $tab= $req_prep->fetch();
            if (($tab->getAdmin()==1)){ //si admin = 1 cela veut dire que admin = true (boolean)
                return true;
            }
            return false;
    }
    
    public static function validate($login){ 
        $sql = "UPDATE Membre SET nonce = 0 WHERE login=:login_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login_tag" => $login,
            );
            $req_prep->execute($values);
    }
    
    public static function banTempo($login){ 
        $sql = "UPDATE Membre SET nonce = 1 WHERE login=:login_tag";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login_tag" => $login,
            );
            $req_prep->execute($values);
    }
    
    public static function getLoginById($id){ 
        $sql = "SELECT login FROM Membre WHERE idMembre=:id";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "id" => $id,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelMembre');
            $tab= $req_prep->fetch();
            return $tab->getLogin();
    }
    
    public static function getIdByLogin($login){ 
        $sql = "SELECT idMembre FROM Membre WHERE login=:login";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login" => $login,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelMembre');
            $tab= $req_prep->fetch();
            return $tab->getIdMembre();
    }
    
}

 ?>
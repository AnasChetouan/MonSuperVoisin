
<?php
	require_once "Model.php";
			
	class ModelCommentaire extends Model{
		protected static $object = "Commentaire";
		protected static $primary='idComm';
    
		private $idComm;
		private $loginU;
		private $appreciation;
		private $etoile;
		private $idProduit;
		private $idMembre;
                
		///////////////////////////////////////////////
		/////////////////GETTER et SETTER////////////// 
		///////////////////////////////////////////////   
			   
	function getIdComm() {
            return $this->idComm;
        }

        function getLoginU() {
            return $this->loginU;
        }

        function getAppreciation() {
            return $this->appreciation;
        }

        function getEtoile() {
            return $this->etoile;
        }

        function getIdProduit() {
            return $this->idProduit;
        }
        
        function getIdMembre() {
            return $this->idMembre;
        }

        function setIdComm($idComm) {
            $this->idComm = $idComm;
        }

        function setLoginU($loginU) {
            $this->loginU = $loginU;
        }

        function setAppreciation($etoile) {
            $this->etoile = $etoile;
        }

        function setCommentaire($commentaire) {
            $this->commentaire = $commentaire;
        }

        function setIdProduit($idProduit) {
            $this->idProduit = $idProduit;
        }
        
        function setIdMembre($idMembre) {
            $this->idMembre = $idMembre;
        }
			  
			  
			 /* public static function getAllCommentaire(){
				    $statement = "SELECT * FROM Commentaire";
					$rep = Model::$pdo->query ( $statement );
					$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommentaire');
					$tab_Comm = $rep->fetchAll();
					return $tab_Comm;
			  }*/
			  
			  public function __construct($l = NULL, $a = NULL, $e = NULL, $ip = NULL, $im = NULL) {
				  if (!is_null($l) && !is_null($a) && !is_null($e) && !is_null($iss)  && !is_null($ip) && !is_null($im)) {
   					$this->loginU = $l;
    					$this->appreciation = $a;
    					$this->etoile = $e;
    					$this->idProduit = $ip;
                                        $this->idMembre = $im;
					}
			  }
        
        public static function selectAllCommByIdProduit($idProduit){
                $sql = "SELECT * FROM Commentaire WHERE idProduit=:produit";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "produit" => $idProduit
                );
                $req_prep->execute($values);
    
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommentaire');
                $tab= $req_prep->fetchAll();
                return $tab;
        }
        
        public static function selectAllCommByLoginU($loginU){
                $sql = "SELECT * FROM Commentaire WHERE loginU=:login";
               $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "login" => $loginU
                );
                $req_prep->execute($values);
    
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommentaire');
                $tab= $req_prep->fetchAll();
                return $tab;
        }
        
        public static function getNoteMoyenne($loginU){
            
            $sql = "SELECT AVG(etoile) FROM Commentaire WHERE loginU=:login";
            $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "login" => $loginU
                );
                $req_prep->execute($values);
    
                //$req_prep->setFetchMode(PDO::FETCH_NUM);
                $rep= $req_prep->fetch(PDO::FETCH_NUM);
                //print_r($rep);
                return $rep[0];
                //return $tab;
        }
        
    }
?>
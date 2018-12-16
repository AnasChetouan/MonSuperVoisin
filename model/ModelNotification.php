<?php

	require_once 'Model.php';

	class ModelNotification extends Model {
		protected static $object = 'Notification';
		protected static $primary = 'idNotif';
		protected static $name = 'message';

		// ATTRIBUTS

		private $idNotif;
                private $idMembre;
                private $message; 
                private $idAdmin; 
                private $reponse;
                private $estRegle; 
                

		// METHODES
                function getIdNotif() {
                    return $this->idNotif;
                }

                function getIdMembre() {
                    return $this->idMembre;
                }

                function getMessage() {
                    return $this->message;
                }

                function getIdAdmin() {
                    return $this->idAdmin;
                }

                function getReponse() {
                    return $this->reponse;
                }

                function getEstRegle() {
                    return $this->estRegle;
                }

                function setIdNotif($idNotif) {
                    $this->idNotif = $idNotif;
                }

                function setIdMembre($idMembre) {
                    $this->idMembre = $idMembre;
                }

                function setMessage($message) {
                    $this->message = $message;
                }

                function setIdAdmin($idAdmin) {
                    $this->idAdmin = $idAdmin;
                }

                function setReponse($reponse) {
                    $this->reponse = $reponse;
                }

                function setEstRegle($estRegle) {
                    $this->estRegle = $estRegle;
                }

                		// CONSTRUCTEUR(S)

		public function __construct ($idMembre=NULL,$message=NULL,$idAdmin=NULL,$reponse=NULL,$estRegle=NULL)
		{
                    if(!is_null($idMembre) && !is_null($message)
                            && !is_null($idAdmin) && !is_null($reponse)
                            && !is_null($estRegle)){
                        
                        $this->idMembre = $idMembre;
			$this->message = $message;
			$this->idAdmin = $idAdmin;
			$this->reponse = $reponse;
			$this->estRegle = $estRegle;
                        }
		}
                
                public static function reponse($idNotif ,$idAdmin, $reponse){
                    $sql = "UPDATE Notification SET idAdmin=:idAdmin_tag, reponse=:reponse_tag, estRegle=1  WHERE idNotif=:id_tag";
                    $req_prep = Model::$pdo->prepare($sql);
                    $values = array(
                        "id_tag" => $idNotif,
                        "idAdmin_tag" => $idAdmin,
                        "reponse_tag" => $reponse,
                    );
                    $req_prep->execute($values);
               }
               
               
                
                
}

 ?>
<?php
require_once File::build_path(array("model","ModelBien.php"));
require_once File::build_path(array("model","ModelService.php"));
require_once File::build_path(array("model","ModelMembre.php"));
require_once File::build_path(array("model","ModelEmprunt.php"));
require_once File::build_path(array("model","ModelCommentaire.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerEmprunt {
    
	protected static $controller="emprunt";
	 
   
    public static function create() {
        if(!empty(Dispatcher::myGet('idBien'))){
            $view = "createBien";
            $pageTitle = "Reservation d'un Bien";
            $controller="emprunt";
        }
        else if(!empty(Dispatcher::myGet('idService'))){
            $view = "createService";
            $pageTitle = "Commande d'un Service";
            $controller="emprunt";
        } else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        $idP = Dispatcher::myGet('idP');
        $tarif = Dispatcher::myGet('tarif');
        $cagnote = Dispatcher::myGet('cagnote');
        if ((intval($cagnote) - intval($tarif)) > 0 ){
            
        $c = new ModelEmprunt(Dispatcher::myGet('idmembre'),ModelMembre::getIdByLogin($_SESSION['login']),$idP,Dispatcher::myGet('estBien'),Dispatcher::myGet('dateDebut'),Dispatcher::myGet('dateFin'));
        if($c->save()) {
            $view = "created";
            $pageTitle = "emprunt ajouté";
            $controller="emprunt";
            ModelBien::pasDispo($idP);
            $nouvelleCagnote1 = (intval($cagnote) - intval($tarif));
            echo $nouvelleCagnote1;
            ModelMembre::gestionCagnote($nouvelleCagnote1,ModelMembre::getIdByLogin($_SESSION['login']));
            ModelMembre::gestionCagnote(intval((ModelMembre::getSoldeByLogin(ModelMembre::getLoginById(Dispatcher::myGet('idmembre')))) + intval($tarif)),Dispatcher::myGet('idmembre'));
            $tab_b = ModelBien::selectAll();
    }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }
    else {
            $view = "errorCreate";
            $pageTitle = "Erreur Cagnote";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
	
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller="emprunt";
	    require_once File::build_path(array('view','view.php'));
	}
	
	public static function listeEmpruntByMembre(){
            $login = htmlspecialchars(Dispatcher::myGet('login'));
            $u = ModelMembre::select($login);
            $id = $u->getIdMembre();
            $tab_d = ModelEmprunt::readAllBienDonneById($id);           
            $tab_e = ModelEmprunt::readAllBienEmprunteById($id);
            $view = 'list';
	    $pageTitle = 'Liste des emprunts';
	    $controller="emprunt";
	    require_once File::build_path(array('view','view.php'));
        }
        
        public static function deleteAllEmpruntsbyMembre(){
            
        }
	
	}

?>


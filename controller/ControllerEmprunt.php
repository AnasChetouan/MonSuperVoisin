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
        $c = new ModelEmprunt(ModelMembre::getIdByLogin($_SESSION['login']),Dispatcher::myGet('idmembre'),Dispatcher::myGet('idP'),Dispatcher::myGet('estBien'),Dispatcher::myGet('dateDebut'),Dispatcher::myGet('dateFin'));
        if($c->save()) {
            $idP = Dispatcher::myGet('idP');
            $view = "detail";
            $pageTitle = "Bien en detail";
            $controller ="bien";
            ModelBien::pasDispo($idP);
            $b = ModelBien::select($idP);
    }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
	
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller="emprunt";
	    File::build_path(array('view','view.php'));
	}
	
	
	
	}

?>


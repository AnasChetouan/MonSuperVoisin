<?php
require_once File::build_path(array("model","ModelBien.php"));
require_once File::build_path(array("model","ModelService.php"));
require_once File::build_path(array("model","ModelMembre.php"));
require_once File::build_path(array("model","ModelCommentaire.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerCommentaire {
    
	protected static $controller="commentaire";
	
      //arguments : void
     //return : void
     //Aplle la vue liste des comms avec tab un tableau avec tous les biens de la BDD
    public static function readAllCommProduit(){
      $idProduit = Dispatcher::myGet('idProduit');
      $tab = ModelCommentaire::selectAllCommByIdProduit($idProduit);
      $pageTitle = "Liste des commentaires sur le produit";
      $controller = "commentaire";
      require_once File::build_path(array("view","view.php"));
    }
    
    //arguments : void
     //return : void
     //Appelle la vue liste des commentaires d'un client
    public static function readAllCommClient(){
      $loginU = Dispatcher::myGet('idMembre');
      echo $loginU;
      $tab = ModelCommentaire::selectAllCommByLoginU($loginU);
    }
    
    //arguments : void
     //return : void
     //Appelle la vue creation d'un commentaire
    public static function create() {
        $typeProduit = Dispatcher::myGet('typeProduit');
        if($typeProduit === 'Bien'){
            $p = ModelBien::select(Dispatcher::myGet('idProduit'));
        }
        if($typeProduit === 'Service'){
            $p = ModelService::select(Dispatcher::myGet('idProduit'));
        }
        $view = "update";
        $pageTitle = "Création d'un commentaire";
        $controller="commentaire";
        $c = new ModelCommentaire();
        $functionCaller = "create";
        require_once File::build_path(array("view","view.php"));
    }

    //arguments : void
     //return : void
    //verifie les arguments avant l'implementation dans la BDD
    public static function created() {
        $typeProduit = Dispatcher::myGet('typeProduit');
        if($typeProduit === 'Bien'){
            $estBien = 1;
        }
        if($typeProduit === 'Service'){
            $estBien = 0;
        }
        $c = new ModelCommentaire(Dispatcher::myGet('idmembre'), Dispatcher::myGet('appreciation'), Dispatcher::myGet('etoile'), Dispatcher::myGet('idP'),ModelMembre::getIdByLogin($_SESSION['login']), $estBien);
        if($c->save()) {
            $idP = Dispatcher::myGet('idP');
            $view = "created";
            $pageTitle = "Commentaire ajouté";
            $controller ="commentaire";
        }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="commentaire";
        }
        require_once File::build_path(array("view","view.php"));
    }
    

    
    //suprime un commentaire en BDD
    public static function delete() {
        ModelCommentaire::delete(Dispatcher::myGet('idC'));
        $view = "deleted";
        $pageTitle = "Commentaire supprimé";
        $controller="commentaire";
        require_once File::build_path(array("view","view.php"));
    }
    
    
    /*
	
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller="commentaire";
	    File::build_path(array('view','view.php'));
	}
	
	*/
	
	
	}

?>


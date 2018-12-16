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
	
      
    public static function readAllCommProduit(){
      $idProduit = Dispatcher::myGet('idProduit');
      $tab = ModelCommentaire::selectAllCommByIdProduit($idProduit);
      $pageTitle = "Liste des commentaires sur le produit";
      $controller = "commentaire";
      require_once File::build_path(array("view","view.php"));
    }
    
    public static function readAllCommClient(){
      $loginU = Dispatcher::myGet('idMembre');
      echo $loginU;
      $tab = ModelCommentaire::selectAllCommByLoginU($loginU);
      //print_r ($tab);
      //print array($tab);
      //echo empty($tab_c);
    }
    
    public static function create() {
        $b = ModelBien::select(Dispatcher::myGet('idProduit'));
        $view = "update";
        $pageTitle = "Création d'un commentaire";
        $controller="commentaire";
        $c = new ModelCommentaire();
        $functionCaller = "create";
        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        $c = new ModelCommentaire(Dispatcher::myGet('idmembre'), Dispatcher::myGet('appreciation'), Dispatcher::myGet('etoile'), Dispatcher::myGet('idP'),ModelMembre::getIdByLogin($_SESSION['login']));
        if($c->save()) {
            $idP = Dispatcher::myGet('idP');
            $view = "created";
            $pageTitle = "Commentaire Supprimé";
            $controller ="commentaire";
        }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="commentaire";
        }
        require_once File::build_path(array("view","view.php"));
    }
    

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


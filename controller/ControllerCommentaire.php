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
    
    /*public static function getNoteMoyenne(){
      $loginU = Dispatcher::myGet('idMembre');
      $tab_c = ModelCommentaire::getNoteMoyenne($loginU);
      $pageTitle = "Liste des commentaires du client";
      $controller = "commentaire";
      require_once File::build_path(array("view","view.php"));
    }*/
    
   
    
    /*
    
    
    public static function create() {
        $view = "create";
        $pageTitle = "Création d'un commentaire";
        $controller="commentaire";
        $c = new ModelCommentaire();
        $functionCaller = "create";
        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        $c = new ModelCommentaire($_SESSION['login'], Dispatcher::myGet('appreciation'), Dispatcher::myGet('comm'), Dispatcher::myGet('SousCategorie'),Dispatcher::myGet('idP'));
        if($c->save()) {
            $idP = Dispatcher::myGet('idP');
            switch($c->getIdSousCategorie()){
                case "Velo":
                    $view2 = "velo";
                    $tab_v = ModelVelo::selectAll();
                    $objet = "le vélo";
                    break;
                case "Accessoire":
                    $view2 = "accessoire";
                    $tab_a = ModelAccessoire::selectAll();
                    $objet = "l'accessoire";
                    break;
                case "PieceDetache":
                    $view2 = "piecedetache";
                    $tab_p = ModelPieceDetache::selectAll();
                    $objet = "la pièce détachée";
                    break;
            }
            $view = "created";
            $pageTitle = "Commentaire ajoutée";
            $controller="commentaire";
            $tab_c = ModelCommentaire::selectAll();
        }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="ccommentaire";
        }
        require_once File::build_path(array("view","view.php"));
    }

    public static function delete() {
        $c = ModelCommentaire::select(Dispatcher::myGet('idC'));
        $idP = $c->getIdProduit();
        ModelCommentaire::delete(Dispatcher::myGet('idC'));
        $id = htmlspecialchars(Dispatcher::myGet('idC'));
        if(Dispatcher::myGet('sousCategorie')=='Velo'){
            $tab_v = ModelVelo::selectAll();
            $view2='velo';
        }else if(Dispatcher::myGet('sousCategorie')=='Accessoire'){
            $tab_a = ModelAccessoire::selectAll();
            $view2='accessoire';
        }else if(Dispatcher::myGet('sousCategorie')=='PieceDetache'){
            $tab_p = ModelPieceDetache::selectAll();
            $view2 = 'pieceDetache';
        }
        $view = "deleted";
        $pageTitle = "Commentaire supprimé";
        $controller="commentaire";
        require_once File::build_path(array("view","view.php"));
    }
    
    
	
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller="commentaire";
	    File::build_path(array('view','view.php'));
	}
	
	*/
	
	
	}

?>


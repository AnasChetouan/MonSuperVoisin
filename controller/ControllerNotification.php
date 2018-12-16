<?php
require_once File::build_path(array("model","ModelMembre.php"));
require_once File::build_path(array("model","ModelNotification.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Session.php"));
require_once File::build_path(array("controller","ControllerCommentaire.php"));

class ControllerNotification{
  
  protected static $controller = "notification";
   
   public static function readAll(){
        $tab_n = ModelNotification::selectAll();
        $view = "list";
        $pageTitle = "Listes des Notifications";
        $controller="notification";
        require_once File::build_path(array("view","view.php"));
   }
  
  public static function create() {
        $u = ModelMembre::select(ModelMembre::getIdByLogin($_SESSION['login']));
        $view = "update";
        $pageTitle = "Envoi d'un message";
        $controller="notification";
        $n = new ModelNotification();
        $functionCaller = "create";
        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        $n = new ModelNotification(Dispatcher::myGet('idMembre'), Dispatcher::myGet('message'),0," ",0);
        if($n->save()) {
          $view = "created";
            $pageTitle = "Message envoyé";
            $controller = "notification";
        }
        else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="notification";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function reponse() {
        if(Session::is_admin()){
        $view = "update";
        $pageTitle = "Envois d'un message";
        $controller="notification";
        $n = ModelNotification::select(Dispatcher::myGet('idNotif'));
        $functionCaller = "reponse";
        require_once File::build_path(array("view","view.php"));
        }
    }
    
    public static function repondu() {
        ModelNotification::reponse(Dispatcher::myGet('idNotif') ,Dispatcher::myGet('idAdmin'), Dispatcher::myGet('reponse'));
        $view = "repondu";
        $pageTitle = "Reponse";
        $controller="notification";
        require_once File::build_path(array("view","view.php"));
    }
  
     public static function delete() {
        if(!empty($_SESSION['login'])){
            ModelNotification::delete(Dispatcher::myGet('idNotif'));
            $login = htmlspecialchars(Dispatcher::myGet('login'));
            $tab_n = ModelNotification::selectAll();
            $view = "deleted";
            $pageTitle = "Notification Supprimé";
            $controller="notification";
            require_once File::build_path(array("view","view.php"));
        }
        else{
            $view="list";
            $tab_u = ModelMembre::selectAll();
            $controller="membre";
            require_once File::build_path(array("view","view.php"));
        }
    }
    
    
}

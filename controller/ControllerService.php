<?php
require_once File::build_path(array("model", "ModelService.php"));
require_once File::build_path(array("controller", "Dispatcher.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerService{
    public static function readAll() {
        $tab_s = ModelService::selectAll(); // stocke tout
        $view = "list";
        $pageTitle = "Listes des services de MonSuperVoisin";
        $controller ="service";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function read() {
        $s = ModelService::select(Dispatcher::myGet('idService'));
        if ($s != false) {
            $view = "commande";
            $pageTitle = "Service en detail";
            $controller ="service";
        }
        else {
            $view = "errorRead";
            $pageTitle = "Erreur";
            $controller ="service";
        }
        require_once File::build_path(array("view","view.php"));
    
    }

    public static function delete() {
        ModelService::delete(Dispatcher::myGet('id'));
        $id = (Dispatcher::myGet('id'));
        $tab_s = ModelService::selectAll();
        $view = "deleted";
        $pageTitle = "Service supprimé";
        $controller ="service";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function update() {
        $v = ModelService::select(Dispatcher::myGet('idService'));
        if ($v != false) {
            $view = "update";
            $pageTitle = "Modification";
            $controller ="service";
        }
        else {
            $view = "errorUpdate";
            $pageTitle = "Erreur";
            $controller ="service";
        }
        $functionCaller = "update";
        require_once File::build_path(array("view","view.php"));
    }
    
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller ="service";
	    File::build_path(array('view','view.php'));
	}
        
}
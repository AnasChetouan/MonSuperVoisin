<?php
require_once File::build_path(array("model", "ModelBien.php"));
require_once File::build_path(array("controller", "Dispatcher.php"));

class ControllerBien{
    public static function readAll() {
        $tab_b = ModelBien::selectAll(); // stocke tout
        $view = "list";
        $pageTitle = "Listes des biens de MonSuperVoisin";
        $controller ="bien";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function read() {
        $b = ModelBien::select(Dispatcher::myGet('id'));
        if ($b != false) {
            $view = "commande";
            $pageTitle = "Bien en detail";
            $controller ="bien";
        }
        else {
            $view = "errorRead";
            $pageTitle = "Erreur";
            $controller ="bien";
        }
        require_once File::build_path(array("view","view.php"));
    
    }

    public static function delete() {
        ModelBien::delete(Dispatcher::myGet('id'));
        $id = (Dispatcher::myGet('id'));
        $tab_b = ModelBien::selectAll();
        $view = "deleted";
        $pageTitle = "Bien supprimé";
        $controller ="bien";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function update() {
        $v = ModelBien::select(Dispatcher::myGet('id'));
        if ($v != false) {
            $view = "update";
            $pageTitle = "Modification";
            $controller ="bien";
        }
        else {
            $view = "errorUpdate";
            $pageTitle = "Erreur";
            $controller ="bien";
        }
        $functionCaller = "update";
        require_once File::build_path(array("view","view.php"));
    }
    
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller ="bien";
	    File::build_path(array('view','view.php'));
	}
        
}
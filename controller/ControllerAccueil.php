<?php

class ControllerAccueil{
  
  protected static $controller = "accueil";
   
   //arguments : void
   //return : void
   //appelle la page d'accueil
   public static function accueil(){
       $pageTitle = "Accueil";
       $view = "accueil";
       $controller="accueil";
       require_once File::build_path(array("view","view.php"));
   }
  
    
}

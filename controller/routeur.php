<?php
require_once'lib/File.php';
require_once File::build_path(array("lib","Session.php"));
require_once File::build_path(array("controller","ControllerBien.php"));
require_once File::build_path(array("controller","ControllerMembre.php"));
//require_once File::build_path(array("controller","ControllerService.php"));
require_once File::build_path(array("controller","Dispatcher.php"));

$controller_default = 'membre';

//$action = "readAll";
$controller = $controller_default;

if(!is_null(Dispatcher::myGet('action'))&&(!is_null(Dispatcher::myGet('controller')))){
    $action = htmlspecialchars(Dispatcher::myGet('action'));
    $controller = htmlspecialchars(Dispatcher::myGet('controller'));
}
else {
    $action = "readAll";
    $controller = $controller_default;
}

$controller_class = "Controller".ucfirst($controller);
$class = get_class_methods($controller_class);
$controller_class::$action();

 /*
if($controller=="Membre"||$controller=="membre"){
   
}*/
//(!is_null(Dispatcher::myGet('action')))&&(!is_null(Dispatcher::myGet('controller')))
?>

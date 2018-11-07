<?php
require_once'lib/File.php';
require_once File::build_path(array("lib","Session.php"));
require_once File::build_path(array("controller","ControllerBien.php"));
require_once File::build_path(array("controller","ControllerMembre.php"));
require_once File::build_path(array("controller","ControllerService.php"));
require_once File::build_path(array("controller","Dispatcher.php"));

$controller_default = 'membre';


if(isset($_COOKIE['preference'])){
  
        $controller_default = $_COOKIE['preference'];
}
    //else if($_COOKIE['preference']==='Membre'){
       // $controller_default = 'Membre';
    //}



$action = "readAll";
$controller = $controller_default;




/*if((!is_null(Dispatcher::myGet('action')))&&(!is_null(Dispatcher::myGet('controller')))){
    $action = htmlspecialchars(Dispatcher::myGet('action'));
    $controller = htmlspecialchars(Dispatcher::myGet('controller'));
}*/

$controller_class = "Controller".ucfirst($controller);
$class = get_class_methods($controller_class);
if($controller=="Membre"||$controller=="membre"){
    $controller_class::$action();
}
else{

if(class_exists($controller_class)||$controller=="Membre"||$controller=="membre"){ // on vérifie si le Controller existe
    
    if((in_array($action,$class))||$controller=="Membre"||$controller=="membre"){ // on vérifie si l'action est présente dans le Controller
        
        //if(Session::is_connected()){ // on vérifie si le visiteur courant est connecté
            
            if($controller=='membre'||$controller='Membre'){
                            $controller_class::$action();
                        }else{
            if(!Session::is_admin()){ // on vérifie si le visiteur est admin (s'il est pas il ne pourra pas créer, modifier ou supprimer des produits ou des membres)
                if($controller!="service"&&$controller!="membre"&&$controller!="Service"&&$controller!="Membre"){
                    if($action=='create'  || $action=='created'|| $action=='update' || $action=='updated' || $action=='delete' || $action=='created'){
                        $view = 'notAdmin'; // on renvoie vers une page d'erreur 
                        $controller = 'membre';
                        require_once File::build_path(array('view','view.php'));
                        
                    }else{ 
                    
                        $controller_class::$action(); // on fait l'action donné par le visiteur
                    
                    }
                }else if($controller=="membre"||$controller="Membre"){
                                    if($action!="update" && $action!="updated" && $action!="delete" && $action!="deconnect" && $action!="deleted"&&$action!="read"&&$action!="readPanier"&&$action!="creationPanier"&&$action!="addPanier"&&$action!="CalculPanier"&&$action!="SupprimerPanier"&&$action!="envoiEmail"){
                                        $view = 'notAdmin';
                                        $controller = 'membre';
                                        require_once File::build_path(array('view','view.php'));
                                    }else if($action=="deconnect"||$action=="readPanier"||$action=="creationPanier"||$action=="addPanier"||$action=="CalculPanier"||$action=="SupprimerPanier"||$action=="envoiEmail"){
                                                $controller_class::$action();
                                            }else{   
                                                if(Session::is_user(Dispatcher::myGet('login'))){
                                                    $controller_class::$action();
                                                }else{
                                                        $view = 'notAdmin';
                                                        $controller = 'membre';
                                                        require_once File::build_path(array('view','view.php'));
                                                }
                                            }
                        }
            
            
                
            }else{
                
                $controller_class::$action();
                
            }
                        }  
        /*}else */ if($controller=="bien" || $controller=="Bien"){
                    if($action=='create'  || $action=='created'|| $action=='update' || $action=='updated' || $action=='delete' || $action=='created'){
                        $view = 'notAdmin';
                        $controller = 'membre';
                        require_once File::build_path(array('view','view.php'));
                    }else{
                        $controller_class::$action(); 
                    }
                }else if($controller=='membre'||$controller=='Membre'){
                            if($action=="deconnect"||$action=="update"||$action=="updated"||$action=="read"||$action=="delete"||$action=="readAll"){
                                $view = 'notAdmin';
                                $controller = 'membre';
                                require_once File::build_path(array('view','view.php'));
                            }else{
                                $controller_class::$action();
                            }
                }
    }else{
        
        echo 'Erreur on a pas trouve la methode que vous voulez';
       // echo 'controller_class  ='.$controller_class.'  et action = '.$action;
    }
}else{
       echo 'Erreur il n\'y a pas de classe a ce nom';

}
}
?>

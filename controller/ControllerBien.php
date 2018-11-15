<?php
require_once File::build_path(array("model", "ModelBien.php"));
require_once File::build_path(array("controller", "Dispatcher.php"));

class ControllerBien{
    public static function readAll() {
        $tab_b = ModelBien::selectAll(); // stocke tout
        $view = "list";
        $pageTitle = "Listes des biens";
        $controller ="bien";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function read() {
        $b = ModelBien::select(Dispatcher::myGet('id'));
        if ($b != false) {
            $view = "detail";
            $pageTitle = "Bien en detail";
            $controller ="bien";
        }
        else {
            $pb = "errorRead";
            $view = "error";
            $message = "Une erreur est survenue, le bien n'a pas été trouvé ! ";
            $pageTitle = "Bien non trouvé";
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
    
    /*public static function update() {
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
    }*/
    
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller ="bien";
	    require_once File::build_path(array('view','view.php'));
	}

    public static function create(){
    	$view = 'update';
    	$pageTitle = 'Proposer un bien';
    	$controller = 'bien';
    	require_once File::build_path(array('view','view.php'));
    }

    public static function created(){
    	$view = 'created';
    	$pageTitle = 'Bien crée';
    	$controller = 'bien';

        $motClef = htmlspecialchars(Dispatcher::myGet('motClef'));
        $titre = htmlspecialchars(Dispatcher::myGet('titre'));
        $description = htmlspecialchars(Dispatcher::myGet('description'));
        $prixNeuf = htmlspecialchars(Dispatcher::myGet('prixNeuf'));

        if (!($motClef === "null")){
            if(is_numeric($prixNeuf)){
                // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
                if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
                {
                    // Testons si le fichier n'est pas trop gros
                    if ($_FILES['photo']['size'] <= 1500000)
                    {
                            // Testons si l'extension est autorisée
                            $infosfichier = pathinfo($_FILES['photo']['name']);
                            if (isset($infosfichier['extension'])){
                                $extension_upload = $infosfichier['extension'];
                                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                if (in_array($extension_upload, $extensions_autorisees))
                                {
                      
                                        $tarif = $prixNeuf/200; // Formule de passage du prix neuf au tarif de location / jour
                                                                // à modifier si besoin
                                        
                                        $b = new ModelBien($titre, $description, $tarif, $motClef, 0, "temp", $prixNeuf, 1); // ...
                                        $b->save();
                                        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($b->updateLienPhoto($extension_upload)));
                                        $view = "created";
                                        $pageTitle = "Bien ajouté";
                                        $controller="bien";
                                        $tab_b = ModelBien::selectAll();
                                }
                                else{
                                    $message = "L'extension du fichier que vous avez envoyé n'est pas autorisée ! \n (Rappel, les extensions autorisées sont : jpg, jpeg, gif, png)";
                                            $view = "error";
                                            $pb = "extension";
                                            $pageTitle = "Erreur extension fichier";
                                            $controller = "bien";
                                }
                            }
                            else{
                                $message = "L'extension du fichier que vous avez envoyé n'est pas autorisée ! \n (Rappel, les extensions autorisées sont : jpg, jpeg, gif, png)";
                                $view = "error";
                                $pb = "extension";
                                $pageTitle = "Erreur extension fichier";
                                $controller = "bien";
                            }
                    }
                    else{
                        $message = "L'image que vous avez envoyée est trop volumineuse ! (Maximum autorisé : 1.5Mo)";
                                $view = "error";
                                $pb = "taille";
                                $pageTitle = "Erreur taille fichier";
                                $controller = "bien";
                    }
                }
                else{
                    if(Conf::getDebug() == true){
                        print_r($_FILES);
                    }
                    else{
                    $message = "Une erreur est apparue lors de l'envoi du fichier, veuillez ré-essayer.";
                            $view = "error";
                            $pb = "erreur_envoi";
                            $pageTitle = "Erreur envoi fichier";
                            $controller = "bien";
                    }
                }
            }
            else{
            $message = "Le prix a été mal défini !";
            $view = "error";
            $pb = "prix";
            $pageTitle = "Erreur prix bien";
            $controller = "bien";
            }
        }
        else{
            $message = "La catégorie du bien n'a pas été définie !";
            $view = "error";
            $pb = "catégorie";
            $pageTitle = "Erreur catégorie bien";
            $controller = "bien";
        }
        require_once File::build_path(array("view","view.php"));
    }
        
}
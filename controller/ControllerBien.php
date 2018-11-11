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

    public static function create(){
        $motClef = Dispatcher::myGet('motClef');
        $titre = Dispatcher::myGet('titre');
        $description = Dispatcher::myGet('description');
        $prixNeuf = Dispatcher::myGet('prixNeuf');
        $i = "1";// à modif plus tarf

        if (!($motClef === "null")){
            // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
            if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
            {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['photo']['size'] <= 1000000)
                {
                        // Testons si l'extension est autorisée
                        $infosfichier = pathinfo($_FILES['photo']['name']);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        if (in_array($extension_upload, $extensions_autorisees))
                        {
                                // On peut valider le fichier et le stocker définitivement
                                $nomPhoto = $i.".".$extension_upload;
                                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($nomPhoto));
                                echo "L'envoi a bien été effectué !";
                        }
                        else{
                            echo "Extension non autorisée !";
                        }
                }
                else{
                    echo "Max 1Mo !";
                }
            }
            else{
                echo "Une erreur s'est déroulée lors de l'envoi du fichier, merci de ré-essayer";
            }
        }
        else{
            echo "Vous n'avez pas choisi la catégorie du bien";
        }
    }
        
}
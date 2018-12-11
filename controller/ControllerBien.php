<?php
require_once File::build_path(array("model", "ModelBien.php"));
require_once File::build_path(array("model", "ModelCommentaire.php"));
require_once File::build_path(array("model", "ModelService.php"));
require_once File::build_path(array("model", "ModelMembre.php"));
require_once File::build_path(array("model", "ModelEmprunt.php"));
require_once File::build_path(array("controller", "Dispatcher.php"));

class ControllerBien{
    public static function readAll() {
        $tab_b = ModelBien::selectAll(); // stocke tout
	ModelEmprunt::actualiserEmprunt();
        $view = "list";
        $pageTitle = "Listes des biens";
        $controller ="bien";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function validate() {
        $idBien = Dispatcher::myGet('idBien');
        ModelBien::validate($idBien);
        ControllerMembre::gestionAnnonces();
    }
    
    public static function desactiver() {
        $idBien = Dispatcher::myGet('idBien');
        ModelBien::desactiver($idBien);
        ControllerMembre::gestionAnnonces();
    }
    
    public static function rechercheBien(){
        $name = Dispatcher::myGet('nom');
        $prix1 = Dispatcher::myGet('prix1');
        $prix2 = Dispatcher::myGet('prix2');
        if(!empty($name)){
            if(!empty($prix1) && !empty($prix2)){
                ControllerBien::rechercheByPrix();
            }
            else ControllerBien::rechercheByName();
        }else {
                $pb = "errorRead";
                $view = "error";
                $message = "Une erreur est survenue lors de la recherche ! ";
                $pageTitle = "Bien non trouvÈ";
                $controller ="bien";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function rechercheByName(){
        $name = Dispatcher::myGet('nom');
        if(!empty($name)){
            if(!empty($_SESSION['login'])){
                $ville = ModelMembre::getVilleByLogin($_SESSION['login']);
                $tab_b = ModelBien::rechercheAvecVille($name,$ville);
            }
            else $tab_b = ModelBien::recherche($name);
            if($tab_b != false){
                $view = "list";
                $pageTitle = "Listes des biens";
                $controller ="bien";
            }
            else {
                $pb = "errorRead";
                $view = "error";
                $message = "Nous n'avons trouvÈ aucun bien corespondant a votre recherche ! ";
                $pageTitle = "Bien non trouvÈ";
                $controller ="bien";
            }
            
        }
        else {
            $pb = "errorRead";
                $view = "error";
                $message = "Une erreur est survenue lors de la recherche ! ";
                $pageTitle = "Bien non trouvÈ";
                $controller ="bien";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function rechercheByPrix(){
        $prix1 = Dispatcher::myGet('prix1');
        $prix2 = Dispatcher::myGet('prix2');
        $name = Dispatcher::myGet('nom');
        if(!empty($name)){
            if(!empty($_SESSION['login'])){
                $ville = ModelMembre::getVilleByLogin($_SESSION['login']);
                $tab_b = ModelBien::rechercheByPrixAvecVille($prix1,$prix2,$name,$ville);
            }
            else $tab_b = ModelBien::rechercheByPrix($prix1,$prix2,$name);
            if(!empty($tab_b)){
                print_r($tab_b);
                $view = "list";
                $pageTitle = "Listes des biens";
                $controller ="bien";
            }
            else {
                $pb = "errorRead";
                $view = "error";
                $message = "Nous n'avons trouvÈ aucun bien corespondant a votre recherche ! ";
                $pageTitle = "Bien non trouvÈ";
                $controller ="bien";
            }
            
        }
        else {
            $pb = "errorRead";
                $view = "error";
                $message = "Une erreur est survenue lors de la recherche ! ";
                $pageTitle = "Bien non trouvÈ";
                $controller ="bien";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function read() {
        $b = ModelBien::select(Dispatcher::myGet('idBien'));
        if ($b != false) {
            $view = "detail";
            $pageTitle = "Bien en detail";
            $controller ="bien";
            $tab = ModelCommentaire::selectAllCommByIdProduit(Dispatcher::myGet('idBien'));
        }
        else {
            $pb = "errorRead";
            $view = "error";
            $message = "Une erreur est survenue, le bien n'a pas ÈtÈ trouvÈ ! ";
            $pageTitle = "Bien non trouvÈ";
            $controller ="bien";
        }
        require_once File::build_path(array("view","view.php"));
    
    }
    public static function delete() {
    	$id = (Dispatcher::myGet('idBien'));
    	$b = ModelBien::select($id);
    	unlink($b->getLienPhoto()); // On supprime la photo associ√©e au bien avant de retirer le bien de la BDD
    	
        ModelBien::delete($id);
        
        $tab_b = ModelBien::selectAll();
        $view = "deleted";
        $pageTitle = "Bien supprimÈ";
        $controller ="bien";
        require_once File::build_path(array("view","view.php"));
    }
    
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller ="bien";
	    require_once File::build_path(array('view','view.php'));
	}

    public static function create(){
    	$view = 'update';
    	$pageTitle = 'Proposer un bien';
        $b = new ModelBien();
        $functionCaller = "create";
    	$controller = 'bien';
    	require_once File::build_path(array('view','view.php'));
    }
    public static function created(){
        $motClef = htmlspecialchars(Dispatcher::myGet('motClef'));
        $titre = htmlspecialchars(Dispatcher::myGet('titre'));
        $description = htmlspecialchars(Dispatcher::myGet('description'));
        $prixNeuf = htmlspecialchars(Dispatcher::myGet('prixNeuf'));
        if (!($motClef === "null")){
            if(is_numeric($prixNeuf)){
                // Testons si le fichier a bien ÈrÈ envoyÈ et s'il n'y a pas d'erreur
                if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
                {
                    // Testons si le fichier n'est pas trop gros
                    if ($_FILES['photo']['size'] <= 1500000)
                    {
                            // Testons si l'extension est autoris√©e
                            $infosfichier = pathinfo($_FILES['photo']['name']);
                            if (isset($infosfichier['extension'])){
                                $extension_upload = $infosfichier['extension'];
                                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                                if (in_array($extension_upload, $extensions_autorisees))
                                {
                      
                                        $tarif = $prixNeuf/200; // Formule de passage du prix neuf au tarif de location / jour
                                                                // A modifier si besoin
                                        
                                        $b = new ModelBien($titre, $description, $tarif, $motClef, 0, "temp", $prixNeuf, 1, ModelMembre::getIdByLogin($_SESSION['login'])); // ...
                                        $b->save();
                                        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($b->updateLienPhoto($extension_upload)));
                                        $view = "created";
                                        $pageTitle = "Bien ajoutÈ";
                                        $controller="bien";
                                        $tab_b = ModelBien::selectAll();
                                }
                                else{
                                    $message = "L'extension du fichier que vous avez envoy√© n'est pas autorisÈe ! \n (Rappel, les extensions autoris√©es sont : jpg, jpeg, gif, png)";
                                            $view = "error";
                                            $pb = "extension";
                                            $pageTitle = "Erreur extension fichier";
                                            $controller = "bien";
                                }
                            }
                            else{
                                $message = "L'extension du fichier que vous avez envoy√© n'est pas autoris√©e ! \n (Rappel, les extensions autoris√©es sont : jpg, jpeg, gif, png)";
                                $view = "error";
                                $pb = "extension";
                                $pageTitle = "Erreur extension fichier";
                                $controller = "bien";
                            }
                    }
                    else{
                        $message = "L'image que vous avez envoy√©e est trop volumineuse ! (Maximum autorisÈ : 1.5Mo)";
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
                    $message = "Une erreur est apparue lors de l'envoi du fichier, veuillez r√©-essayer.";
                            $view = "error";
                            $pb = "erreur_envoi";
                            $pageTitle = "Erreur envoi fichier";
                            $controller = "bien";
                    }
                }
            }
            else{
            $message = "Le prix a ÈtÈ mal dÈfini !";
            $view = "error";
            $pb = "prix";
            $pageTitle = "Erreur prix bien";
            $controller = "bien";
            }
        }
        else{
            $message = "La catÈgorie du bien n'a pas ÈtÈ dÈfinie !";
            $view = "error";
            $pb = "categorie";
            $pageTitle = "Erreur catÈgorie bien";
            $controller = "bien";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function update(){
        if(isset($_SESSION['login'])){
            $idBien = Dispatcher::myGet('idBien');
            $b = ModelBien::select($idBien);
            if($b != false){
            $idProprio = $b->getIdProprio(); // A FINIR
                if($idProprio == ModelMembre::getIdByLogin($_SESSION['login']) || Session::is_admin()){
                    // Si l'id du proprio du bien est la m√™me que celle du membre connect√©
                    // Donc on vÈrifie que c'est bien le proprio qui veut modifier son bien
                    $functionCaller = "update";
                    $view = "update";
                    $pageTitle = "Modification";
                    $controller="bien";
                }
                else{
                    $view = "error";
                    $message = "Vous n'Ítes pas autorisÈ ‡†modifier ce bien !";
                    $pageTitle = "Erreur modificaiton";
                    $controller="bien";
                    $pb = "autorisation";
                }
            }
            else {
                $view = "error";
                $message = "Nous n'avons pas pu trouver ce bien !";
                $pageTitle = "Erreur 404";
                $controller="bien";
                $pb = "update";
                }
        }
        else{ // On lui demande de se connecter si jamais il ne l'est pas d√©j√† 
            $view="connect";  
            $controller="membre";
            $pageTitle = "Page de connexion";
        }
        
        require_once File::build_path(array("view","view.php"));

    }
    
    public static function updated() {
        if (Dispatcher::myGet('motClef') != "null"){
            if(is_numeric(Dispatcher::myGet('prixNeuf'))){
	            $tarif = Dispatcher::myGet('prixNeuf')/200; // Formule de passage du prix neuf au tarif de location / jour
	            // √† modifier si besoin       
                    $b = ModelBien::select(Dispatcher::myGet('idBien'));
                    //print_r($b);
                    $estDispo = $b->getEstDispo();
                    if (Session::is_admin()){ // Si c'est un admin qui modifie, on valide directement
                        $estValide = 1;
                    }
                    else
                    {
                        $estValide = 0;
                    }
                    if($b != false) {
                            $data = array(
                                "idBien" => Dispatcher::myGet('idBien'),
                                "titre" => Dispatcher::myGet('titre'),
                                "motClef" => Dispatcher::myGet('motClef'),
                                "estDispo" => $estDispo,
                                "estValide" => $estValide,
                                "description" => htmlspecialchars(Dispatcher::myGet('description')),
                                "prixNeuf" => Dispatcher::myGet('prixNeuf'),
                                "tarif" => $tarif
                        );
                        //print_r($data);  
                        $b->update($data);
                  
	                $controller="bien";
	                $view = "updated";
	                $pageTitle = "Bien modifiÈ";
	                $idProprio = $b->getIdProprio();
	                $tab_b = ModelBien::selectAll();
	                
	            } 
	            else {
	            	$view = "error";
	                $message= "Nous avons eu une erreur lors de la modification du bien";
	                $pageTitle = "Erreur update";
	                $controller="bien";
	                $pb ="update";
	            }
	        }

            else{
	            $message = "Le prix a √©t√© mal d√©fini !";
	            $view = "error";
	            $pb = "prix";
	            $pageTitle = "Erreur prix bien";
	            $controller = "bien";
            }
        }

        else{
            $message = "La cat√©gorie du bien n'a pas √©t√© d√©finie !";
            $view = "error";
            $pb = "cat√©gorie";
            $pageTitle = "Erreur cat√©gorie bien";
            $controller = "bien";
        }
        require_once File::build_path(array("view","view.php"));

    }

}
        
        

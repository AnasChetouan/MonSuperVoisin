<?php
require_once File::build_path(array("model", "ModelService.php"));
require_once File::build_path(array("controller", "Dispatcher.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerService{
    public static function readAll() {
        $tab_s = ModelService::selectAll(); // stocke tout
        $controller ="service";
        $view = "list";
        $pageTitle = "Listes des services";
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function read() {
        $s = ModelService::select(Dispatcher::myGet('idService'));
        if ($s != false) {
            $view = "detail";
            $pageTitle = "Service en detail";
            $controller ="service";
        }
        else {
            $pb = "errorRead";
            $view = "error";
            $message = "Une erreur est survenue, le service n'a pas été trouvé ! ";
            $pageTitle = "Service non trouvé";
            $controller ="service";
        }
        require_once File::build_path(array("view","view.php"));
    
    }

    public static function validate() {
        $idService = Dispatcher::myGet('idService');
        ModelService::validate($idService);
        //ControllerMembre::gestionAnnonces();
    }

    public static function desactiver() {
        $idService = Dispatcher::myGet('idService');
        ModelService::desactiver($idService);
        //ControllerMembre::gestionAnnonces();
    }

    public static function delete() {
        $id = (Dispatcher::myGet('idService'));
        $s = ModelService::select($id);

        ModelService::delete($id);
        
        //$tab_b = ModelBien::selectAll();
        $view = "deleted";
        $pageTitle = "Service supprimé";
        $controller ="service";
        require_once File::build_path(array("view","view.php"));
    }

    public static function create(){
        $functionCaller = "create";
        $controller = 'service';
        $view = 'update';
        $pageTitle = 'Proposer un service';
        $s = new ModelService();
        require_once File::build_path(array('view','view.php'));
    }

    public static function created(){
        $motClef = htmlspecialchars(Dispatcher::myGet('motClef'));
        $description = htmlspecialchars(Dispatcher::myGet('description'));
        $tarif = htmlspecialchars(Dispatcher::myGet('tarif'));

        $codes = [
            0 => 'lundi-1',
            1 => 'lundi-2',
            2 => 'mardi-1',
            3 => 'mardi-2',
            4 => 'mercredi-1',
            5 => 'mercredi-2',
            6 => 'jeudi-1',
            7 => 'jeudi-2',
            8 => 'vendredi-1',
            9 => 'vendredi-2',
            10 => 'samedi-1',
            11 => 'samedi-2',
            12 => 'dimanche-1',
            13 => 'dimanche-2'
        ];

        $values = array();
        $jours = array();

        for ($i = 0; $i < 14; $i++) {
            if (($horaire = Dispatcher::myGet($codes[$i])) != NULL){
                array_push($values, $horaire);
                array_push($jours, ucfirst(substr($codes[$i], 0, -2)));
            }
        }

        //print_r($values);
        //print_r($jours);

        $disponibilites = ModelService::compresserDispos($values, $jours);
        //echo "dispo : ".$disponibilites;

        if (!($motClef === "null")){
            if(is_numeric($tarif)){
                if(!empty($values)){

                    $s = new ModelService($description, $tarif, $motClef, 0, $disponibilites, ModelMembre::getIdByLogin($_SESSION['login']));
                    $s->save();

                    $controller = 'service';
                    $view = 'created';
                    $pageTitle = 'Service ajouté';
                }
                else{
                    $message = "Aucun jour n'a été choisi !";
                    $view = "error";
                    $pb = "dispo";
                    $pageTitle = "Erreur disponibilités";
                    $controller = "service";
                }
            }
            else{
                $message = "Le tarif a été mal défini !";
                $view = "error";
                $pb = "prix";
                $pageTitle = "Erreur tarif horaire";
                $controller = "service";
            }
        }
        else{
            $message = "La catégorie du bien n'a pas été définie !";
            $view = "error";
            $pb = "categorie";
            $pageTitle = "Erreur tarif horaire";
            $controller = "service";
        }

        require_once File::build_path(array('view', 'view.php'));
    }


    
    public static function update(){
        if(isset($_SESSION['login'])){
            $idService = Dispatcher::myGet('idService');
            $s = ModelService::select($idService);
            if($s != false){
            $idProprio = $s->getIdProprio();
                if($idProprio == ModelMembre::getIdByLogin($_SESSION['login']) || Session::is_admin()){
                    // Si l'id du proprio du bien est la même que celle du membre connecté
                    // Donc on vérifie que c'est bien le proprio qui veut modifier son bien
                    $functionCaller = "update";
                    $view = "update";
                    $pageTitle = "Modification";
                    $controller="service";
                }
                else{
                    $view = "error";
                    $message = "Vous n'êtes pas autorisé à modifier ce bien !";
                    $pageTitle = "Erreur modificaiton";
                    $controller="bien";
                    $pb = "autorisation";
                }
            }
            else {
                $view = "error";
                $message = "Nous n'avons pas pu trouver ce bien !";
                $pageTitle = "Erreur 404";
                $controller="service";
                $pb = "update";
                }
        }
        else{ // On lui demande de se connecter si jamais il ne l'est pas déjà
            $view="connect";  
            $controller="membre";
            $pageTitle = "Page de connexion";
        }
        
        require_once File::build_path(array("view","view.php"));

    }

  public static function updated() {
        $motClef = htmlspecialchars(Dispatcher::myGet('motClef'));
        $description = htmlspecialchars(Dispatcher::myGet('description'));
        $tarif = htmlspecialchars(Dispatcher::myGet('tarif'));

        $codes = [
            0 => 'lundi-1',
            1 => 'lundi-2',
            2 => 'mardi-1',
            3 => 'mardi-2',
            4 => 'mercredi-1',
            5 => 'mercredi-2',
            6 => 'jeudi-1',
            7 => 'jeudi-2',
            8 => 'vendredi-1',
            9 => 'vendredi-2',
            10 => 'samedi-1',
            11 => 'samedi-2',
            12 => 'dimanche-1',
            13 => 'dimanche-2'
        ];

        $values = array();
        $jours = array();

        for ($i = 0; $i < 14; $i++) {
            if (($horaire = Dispatcher::myGet($codes[$i])) != NULL){
                array_push($values, $horaire);
                array_push($jours, ucfirst(substr($codes[$i], 0, -2)));
            }
        }

        //print_r($values);
        //print_r($jours);

        $disponibilites = ModelService::compresserDispos($values, $jours);
        //echo "dispo : ".$disponibilites;

        if (!($motClef === "null")){
            if(is_numeric($tarif)){
                if(!empty($values)){

                    $s = ModelService::select(Dispatcher::myGet('idService'));
                    if($s != false) {
                        if (Session::is_admin()){ // Si c'est un admin qui modifie, on valide directement
                            $estValide = 1;
                        }
                        else
                        {
                            $estValide = 0;
                        }  
                        $data = array(
                            "idService" => Dispatcher::myGet('idService'),
                            "motClef" => Dispatcher::myGet('motClef'),
                            "estValide" => $estValide,
                            "description" => htmlspecialchars(Dispatcher::myGet('description')),
                            "disponibilites" => $disponibilites,
                            "tarif" => $tarif
                        );

                        //print_r($data);  
                        $s->update($data);
                      
                        $controller="service";
                        $view = "updated";
                        $pageTitle = "Service modifié";

                        $idProprio = $s->getIdProprio(); // utile pour savoir qui vient de modifier son service (on s'en sert dans updated)
                        //$tab_b = ModelBien::selectAll();
                    
                    } 
                    else {
                        $view = "error";
                        $message= "Nous avons eu une erreur lors de la modification du service";
                        $pageTitle = "Erreur update";
                        $controller="service";
                        $pb ="update";
                    }

                }
                else{
                    $message = "Aucun jour n'a été choisi !";
                    $view = "error";
                    $pb = "dispo";
                    $pageTitle = "Erreur disponibilités";
                    $controller = "service";
                }
            }
            else{
                $message = "Le tarif a été mal défini !";
                $view = "error";
                $pb = "prix";
                $pageTitle = "Erreur tarif horaire";
                $controller = "service";
            }
        }
        else{
            $message = "La catégorie du service n'a pas été définie !";
            $view = "error";
            $pb = "categorie";
            $pageTitle = "Erreur tarif horaire";
            $controller = "service";
        }

        require_once File::build_path(array('view', 'view.php'));

    }
    
	public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller ="service";
	    File::build_path(array('view','view.php'));
	}
        
}

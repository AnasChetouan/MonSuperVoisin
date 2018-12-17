<?php
require_once File::build_path(array("model","ModelBien.php"));
require_once File::build_path(array("model","ModelService.php"));
require_once File::build_path(array("model","ModelMembre.php"));
require_once File::build_path(array("model","ModelEmprunt.php"));
require_once File::build_path(array("model","ModelCommentaire.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Session.php"));

class ControllerEmprunt {
    
	protected static $controller="emprunt";
	 
   
    public static function create() {
        if(!empty(Dispatcher::myGet('idBien'))){
            $view = "createBien";
            $pageTitle = "Reservation d'un Bien";
            $controller="emprunt";
        }
        else if(!empty(Dispatcher::myGet('idService'))){
            $view = "createService";
            $pageTitle = "Commande d'un Service";
            $controller="emprunt";
        } else {
            $view = "errorCreate";
            $pageTitle = "Erreur Doublon";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }

    public static function createdBien() {
        $idP = Dispatcher::myGet('idP');
        $tarif = Dispatcher::myGet('tarif');
        
        $datetime1 = date_create(Dispatcher::myGet('dateDebut'));
        $datetime2 = date_create(Dispatcher::myGet('dateFin'));
        $interval = date_diff($datetime1, $datetime2);
        
        $nbJours = intval(substr($interval->format('%R%a'),1));
        $prixAPayer = $tarif * $nbJours;
        $cagnote = Dispatcher::myGet('cagnote');
        if ((intval($cagnote) - intval($prixAPayer)) > 0 ){
            
            $c = new ModelEmprunt(Dispatcher::myGet('idmembre'),ModelMembre::getIdByLogin($_SESSION['login']),$idP,Dispatcher::myGet('estBien'),Dispatcher::myGet('dateDebut'),Dispatcher::myGet('dateFin'));
            if($c->save()) {
                $view = "created";
                $redirection = 'bien';
                $pageTitle = "Emprunt ajouté";
                $controller="emprunt";
                ModelBien::pasDispo($idP);
                $nouvelleCagnote1 = (intval($cagnote) - intval($prixAPayer));
                ModelMembre::gestionCagnote($nouvelleCagnote1,ModelMembre::getIdByLogin($_SESSION['login']));
                ModelMembre::gestionCagnote(intval((ModelMembre::getSoldeByLogin(ModelMembre::getLoginById(Dispatcher::myGet('idmembre')))) + intval($prixAPayer)),Dispatcher::myGet('idmembre'));
                $tab_b = ModelBien::selectAll();
            }
            else {
                $view = "errorCreate";
                $redirection = "bien";
                $pageTitle = "Une erreur est survenue lors de la validation de votre emprunt, veuillez contacter un administrateur si le problème persiste.";
                $controller="emprunt";
            }
        }
        else {
            $view = "errorCreate";
            $redirection = "bien";
            $pageTitle = "Erreur cagnotte";
            $message = "Votre cagnotte actuelle ne vous permet pas d'emprunter ce bien pour ce nombre de jours !";
            $controller="emprunt";
        }
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function createdService() {
        $dateChoisie = Dispatcher::myGet('date');
        $nbH = Dispatcher::myGet('nbH');
        $tarif = Dispatcher::myGet('tarif');
        $cagnotte = Dispatcher::myGet('cagnotte');
        $idProduit = Dispatcher::myGet('idProduit');
        $s = ModelService::select($idProduit);
        
        $dateFinDT = new DateTime($dateChoisie.' +1 day');
        $dateFin = $dateFinDT->format('Y-m-d');
        
        //echo 'Date deb : '.$dateChoisie.' Date fin : '.$dateFin;
        
        $nomJour = new DateTime($dateChoisie);
        
        $traductionJours = array(
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche'
        );
        
        $jourAnglais = date_format($nomJour, 'l');
        
        $jourChoisi = $traductionJours[$jourAnglais];
        
        $joursDispo = $s->getJoursDispo();
        //print_r($joursDispo);
        
        $existe = false;
        
        foreach ($joursDispo as $key=>$value) {
            if ($value === $jourChoisi){
                $existe = true;
            }
        }

        if($existe){
            $serviceNBH = $s->getNbHeuresByJour($jourChoisi);
            if ($nbH <= $serviceNBH){
                $prixAPayer = intval($nbH)*intval($tarif);
                if( ( intval($cagnotte) - $prixAPayer) > 0){
                    
                    $e = new ModelEmprunt(
                            Dispatcher::myGet('idProprio'),
                            ModelMembre::getIdByLogin($_SESSION['login']),
                            $idProduit,
                            0,
                            $dateChoisie,
                            $dateFin
                            );
                    if($e->save()){
                        $nouvelleCagnotte = (intval($cagnotte) - intval($prixAPayer));
                        ModelMembre::gestionCagnote($nouvelleCagnotte,ModelMembre::getIdByLogin($_SESSION['login']));
                        $view = "created";
                        $redirection = 'service';
                        $pageTitle = "Emprunt ajouté";
                        $controller="emprunt";
                    }
                    else{ // Erreur de BDD dans le save
                        $view = "errorCreate";
                        $redirection = "service";
                        $pageTitle = "Une erreur est survenue lors de la validation de votre emprunt, veuillez contacter un administrateur si le problème persiste.";
                        $controller="emprunt";
                    }
                }
                else{ // Erreur : Il n'a pas assez pour réserver ce service à ce tarif pour ce nombre d'heures
                    $view = "errorCreate";
                    $redirection = "service";
                    $pageTitle = "Erreur cagnotte";
                    $message = "Votre cagnotte actuelle ne vous permet pas d'utiliser ce service pour ce nombre d'heures !";
                    $controller="service";
                }
            }
            else{ // Erreur : + d'heures choisi que les dispos du service
                $view = "errorCreate";
                $redirection = "service";
                $pageTitle = "Erreur horaires";
                $message = "Le nombre d'heures choisi n'est pas conforme aux disponibilités de la personne";
                $controller="emprunt";   
            }
        }
        else{ // Erreur : jour choisi pas dans les dispo du service
            $view = "errorCreate";
            $redirection = "service";
            $pageTitle = "Erreur date";
            $message = "Vous avez choisi une date qui ne fait pas partie des jours de disponibilités de cette personne !";
            $controller="emprunt";
        }

        require_once File::build_path(array("view","view.php"));
    }
	
    public static function error(){
	    $view = 'error';
	    $pageTitle = 'Erreur';
	    $controller="emprunt";
	    require_once File::build_path(array('view','view.php'));
    }
	
    public static function listeEmpruntByMembre(){
            $login = htmlspecialchars(Dispatcher::myGet('login'));
            $u = ModelMembre::select($login);
            $id = $u->getIdMembre();
            $tab_d = ModelEmprunt::readAllBienDonneById($id);           
            $tab_e = ModelEmprunt::readAllBienEmprunteById($id);
            $view = 'list';
	    $pageTitle = 'Liste des emprunts';
	    $controller="emprunt";
	    require_once File::build_path(array('view','view.php'));
        }
        
	
}

?>


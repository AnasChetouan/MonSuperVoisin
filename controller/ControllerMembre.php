<?php
require_once File::build_path(array("model","ModelMembre.php"));
require_once File::build_path(array("model","ModelCommentaire.php"));
require_once File::build_path(array("lib","Security.php"));
require_once File::build_path(array("controller","Dispatcher.php"));
require_once File::build_path(array("lib","Session.php"));
require_once File::build_path(array("controller","ControllerCommentaire.php"));

class ControllerMembre{
  
  protected static $controller = "membre";
   
   
   public static function readAll(){
        $tab_u = ModelMembre::selectAll();
        $view = "list";
        $pageTitle = "Listes des Membres";
        $controller="membre";
        require_once File::build_path(array("view","view.php"));
   }
   
    public static function connect(){
       if(!isset($_SESSION['login'])){
            $view = "connect";
            $functionCaller='connect';
            $pageTitle = "Page de connexion";
            $controller="membre";
            require_once File::build_path(array("view","view.php"));
        }
        else{
           self::read();
        }
  }
  
   public static function readAllActions(){
       $view = 'actions';
       $pageTitle = "Liste des actions possibles";
       $controller="membre";
       require_once File::build_path(array("view","view.php"));
   }
    
    public static function connected(){
        if(!is_null(Dispatcher::myGet('mdp'))&& !is_null(Dispatcher::myGet('login'))){
            $mdp_chiffre= Security::chiffrer(htmlspecialchars(Dispatcher::myGet('mdp'))); //Dispatcher::myGet('mdp');
            if(ModelMembre::checkPassword(htmlspecialchars(Dispatcher::myGet('login')),$mdp_chiffre)==true){//on vérifie si le couple login/mdp est présent dans la bdd      
                $u = ModelMembre::select(Dispatcher::myGet('login'));
                if($u->getNonce()==0){
                    $_SESSION['login']=Dispatcher::myGet('login');        
                    if(ModelMembre::adminOrNot(Dispatcher::myGet('login'),$mdp_chiffre)==true){ //on vérifie si l'membre qui vient de se connecter est admin ou pas
                        $_SESSION['admin'] = true;
                    } else{
                        $_SESSION['admin'] = false;
                    }
                    self::read();
                }else{
                    $view = "error";
                    $message = 'Compte non confirmé, nos administrateurs sont sur le coup ! '; // $message est une variable qu'on transmet a error.php pour gerer les erreurs
                    $controller="membre";
                    $pageTitle="Compte non confirmé";
                    $pb = "connexion";// $pb est une variable qui permet de gerer le retour en arièrre (sur la view error.php)
                    require_once File::build_path(array("view","view.php"));
                }
            
            }else{
                    $message = "Votre compte n'existe pas ! Veuillez réessayer !";
                    $view="error";
                    $controller="membre";
                    $pageTitle="Compte inexistant";
                    $pb= "connexion";
                    require_once File::build_path(array("view","view.php"));
                    
            }
        }
        else{
            $view="error";
            $controller="membre";
            $pageTitle="Champ manquant";
            $message="Vous n'avez pas rempli tous les champs";
            $pb = "connexion";
            require_once File::build_path(array("view","view.php"));
        }
    }
    
    public static function deconnect(){
        
        $_SESSION = array();
        // Destruction de la session
        session_destroy();
        // Destruction du tableau de session
        unset($_SESSION);
        
        if(!isset($_SESSION['login'])){
          
           $view = 'deconnected';
           $pageTitle="Deconnecté";
          $controller="membre";
            require_once File::build_path(array("view","view.php"));
        } else {
            $message = "Il y a eu une erreur au niveau de la déconnexion veuillez nous en excuser !";
            $view = 'error';
            $pageTitle="Deconnecté";
            $controller="membre";
            $pb = "connexion";
            require_once File::build_path(array("view","view.php"));
        }
    }
    
    public static function read() {
        if(!empty($_SESSION['login']))
        {
	    $login = htmlspecialchars(Dispatcher::myGet('login'));
            $u = ModelMembre::select($login);
            $loginU = Dispatcher::myGet('idMembre');
            $tab = ModelCommentaire::selectAllCommByLoginU($loginU);
            $id = $u->getIdMembre();
            $tab_e = ModelEmprunt::readAllBienDonneById($id);           
            //$tab_d = ModelEmprunt::readAllBienEmprunteById(ModelMembre::getIdByLogin(Dispatcher::myGet('login')));
            if ($u != false) {
                $view = "detail";
                $pageTitle = "Membre en detail";
                $controller="membre";
                
            }
            else {
                $message = "Nous n'avons pas réussi a trouver le détail de votre compte !";
                $view = "error";
                $pageTitle = "Erreur";
                $controller="membre";
                $pb = "connexion";
            }
            require_once File::build_path(array("view","view.php"));
        }
        else
        {
          
            $message = "Cette page n'est accessible qu'aux utilisateurs connectés";
            $view = "error";
            $pageTitle = "Erreur";
            $controller="membre";
            $pb = "connexion";
            require_once File::build_path(array("view","view.php"));
       
        }
    }

     public static function delete() {
        if(Session::is_user(Dispatcher::myGet('login'))||Session::is_admin()){
            
            
            ModelEmprunt::deleteAllEmpruntsbyProposant(ModelMembre::getIdByLogin(Dispatcher::myGet('login')));
            ModelEmprunt::deleteAllEmpruntsbyAcceptant(ModelMembre::getIdByLogin(Dispatcher::myGet('login')));
            ModelBien::deleteAllBiensbyMembre(ModelMembre::getIdByLogin(Dispatcher::myGet('login')));
            ModelService::deleteAllServicesbyMembre(ModelMembre::getIdByLogin(Dispatcher::myGet('login')));
            ModelMembre::delete(Dispatcher::myGet('login'));
            $login = htmlspecialchars(Dispatcher::myGet('login'));
            $tab_u = ModelMembre::selectAll();
            $view = "deleted";
            $pageTitle = "Membre Supprimé";
            $controller="membre";
            if(Session::is_user(Dispatcher::myGet('login'))){
                $_SESSION = array();
                // Destruction de la session
                session_destroy();
                // Destruction du tableau de session
                unset($_SESSION);
            }
            require_once File::build_path(array("view","view.php"));
        }
        else{
            $view="connect";
            $controller="membre";
            require_once File::build_path(array("view","view.php"));
        }
    }
    
    
    public static function create() {
        $view = "update";
        $pageTitle = "Creation de membre";
        $u = new ModelMembre();
        $functionCaller = "create";
        $controller="membre";
        require_once File::build_path(array("view","view.php"));
    }

    public static function created() {
        $mdp = htmlspecialchars(Dispatcher::myGet('mdp'));
        
            if(strlen(Dispatcher::myGet('mdp')) >= 6)
            {
                if(Dispatcher::myGet('mdp') == Dispatcher::myGet('mdp2')){
                    if(!preg_match("/(([a-z][0-9])|([0-9][a-z])|[A-Z][0-9]|([0-9][A-Z]))/",Dispatcher::myGet('mdp')))
                    {
                        $message = "- Le mot de passe doit comporter des lettres et des chiffres.<br/>";
                        $view="error";
                        $controller="membre";
                        $pageTitle="Erreur mot de passe";
                        $pb="mdp";
                    }else{
                    $mdp_chiffre = Security::chiffrer(Dispatcher::myGet('mdp'));
                    //$nonce_aleatoire = Security::generateRandomHex();
                    //$u = new ModelMembre(Dispatcher::myGet('login'), $mdp_chiffre, Dispatcher::myGet('nom'), Dispatcher::myGet('prenom'), Dispatcher::myGet('email').'@yopmail.com',0,$nonce_aleatoire);// le 0 est la valeur de admin ce qui équivaut à false en booléan
                    
                        $date = date('Y-m-d');
                        
                        $u = new ModelMembre(Dispatcher::myGet('login'),
                            Dispatcher::myGet('nom'), Dispatcher::myGet('prenom'),
                            Dispatcher::myGet('adresse'),Dispatcher::myGet('mail'),
                            $mdp_chiffre,Dispatcher::myGet('ville'),
                            Dispatcher::myGet('telephone'),0,0,0,0,Dispatcher::myGet('codePostal'),
                            $date,0,1);
                        
                    if($u->save()) {
                            $view = "created";
                            $pageTitle = "Membre ajouté";
                            $controller="membre";
                            $tab_u = ModelMembre::selectAll();
                    }
                    else {
                        $message = "Ce login est déjaé utilisé par un de nos membres";
                        $view = "error";
                        $pb = "mdp";
                        $pageTitle = "Erreur Doublon";
                        $controller="membre";
                    }
                }
                }
                else{
                    $message = "Vos mots de passe ne sont pas les mémes";
                    $view = "error";
                    $pb = "mdp";
                    $pageTitle = "Erreur création membre(mdp)";
                    $controller = "membre";
                  
                }
            }
            else{
                $message = "Votre mot de passe est inferieur a 6 caractéres";
                $view = "error";
                $pageTitle = "mdp<6";
                $pb = "mdp";
                $controller="membre";
            }
        
        
        require_once File::build_path(array("view","view.php"));
    }
    
    public static function validate() {
        $login = Dispatcher::myGet('login');
        ModelMembre::validate($login);
        ControllerMembre::readAll();
    }
    
    public static function banTempo() {
        $login = Dispatcher::myGet('login');
        ModelMembre::banTempo($login);
        ControllerMembre::readAll();
    }
    

    public static function update() { 
        if(!is_null(Dispatcher::myGet('login'))){ //si la personne effectuant l'action est un admin ou l'membre dont il veut modifier les parametres alors on va vers la page update.php
                $u = ModelMembre::select(Dispatcher::myGet('login'));
                if ($u != false) {
                    $view = "update";
                    $pageTitle = "Modification";
                    $controller="membre";
                }
                else {
                    $view = "error";
                    $message = "Nous n'avons pas pu trouver cet utilisteur !";
                    $pageTitle = "Erreur";
                    $controller="membre";
                    $pb = "update";
                }
                $functionCaller = "update";
                if(Session::is_admin()){
                    $admin = "oui";
                }
                else{ 
                    $admin = "non";
                    
                }
                      
            }
            
        else {
                $view="connect";  
                $controller="membre";
        }
        require_once File::build_path(array("view","view.php"));
        
               
    }
        
    

    public static function updated() {
        if(strlen(Dispatcher::myGet('mdp')) >= 6){
                if(Dispatcher::myGet('mdp') == Dispatcher::myGet('mdp2')){
                    if(!preg_match("/(([a-z][0-9])|([0-9][a-z])|[A-Z][0-9]|([0-9][A-Z]))/",Dispatcher::myGet('mdp')))
                    {
                        $message = "- Le mot de passe doit comporter des lettres et des chiffres.<br/>";
                        $view="error";
                        $controller="membre";
                        $pageTitle="Erreur mot de passe";
                        $pb="mdp";
                    }else{
                        $mdp_chiffre = Security::chiffrer(Dispatcher::myGet('mdp'));
                        $u = ModelMembre::select(Dispatcher::myGet('login'));
                        if(Session::is_admin()){
                            if(Dispatcher::myGet('admin')=="oui"){
                                $valeur = 1; 
                            }else{
                                $valeur = 0;
                            }
                        }else{
                            $valeur = 0;
                        }
                        $nonce = 1;
                        if($u != false) {
                            $data = array(
                                "login" => Dispatcher::myGet('login'),
                                "nom" => Dispatcher::myGet('nom'),
                                "prenom" => Dispatcher::myGet('prenom'),
                                "mail" => Dispatcher::myGet('mail'),
                                "telephone" => Dispatcher::myGet('telephone'),
                                "adresse" => Dispatcher::myGet('adresse'),
                                "ville" => Dispatcher::myGet('ville'),
                                "codePostal" => Dispatcher::myGet('codePostal'),
                                "mdp" => $mdp_chiffre,
                                "admin" => $valeur,
                                "nonce" => $nonce
                        );
                        $u->update($data);

                        $login = htmlspecialchars(Dispatcher::myGet('login'));
                        $tab_u = ModelMembre::selectAll();
                        $view = "updated";
                        $pageTitle = "Membre Modifié";
                        $controller="membre";
                    }
                    else {
                    $view = "error";
                    $message= "Nous avons eu une erreur lors de la création ou la modification du compte";
                    $pageTitle = "Erreur update";
                    $controller="membre";
                    $pb ="update";
                    }
                require_once File::build_path(array("view","view.php"));
                }
            }
                else{
                    $message = "Vos mots de passe ne sont pas les mémes";
                    $view = "error";
                    $pb = "mdp";
                    $pageTitle = "Erreur création membre(mdp)";
                    $controller = "membre";
                  
                }
        }
            else{
                $message = "Votre mot de passe est inferieur a 6 caractéres";
                $view = "error";
                $pageTitle = "mdp<6";
                $pb = "mdp";
                $controller="membre";
            }
            require_once File::build_path(array("view","view.php"));
    }
    
    public static function gestionAnnonces(){
        $tab_b = ModelBien::selectAll();
        $tab_s = ModelService::selectAll();
        $view = "listAnnonces";
        $pageTitle = "Liste des Annonces";
        $controller="membre";
        require_once File::build_path(array("view","view.php"));
    }
    
}
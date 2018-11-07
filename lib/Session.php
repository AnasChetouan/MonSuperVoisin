<?php 
    class Session {
    
    // retourne true si le visiteur courant de la page est connecté
    public static function is_connected(){
        return (!empty($_SESSION['login']));
    }
    
    //retourne true si le login indiqué en parametre est le meme que celui de l'utilisateur connecté
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }
    
    //retourne true si l'utilisateur connecté est administrateur
    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }
}
?>
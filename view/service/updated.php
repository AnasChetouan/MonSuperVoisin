<?php
    if (!Session::is_admin()){
        echo "<p>Votre demande de mise à jour a bien été prise en compte ! <br> Votre annonce ne sera plus visible sur le site jusqu'à ce qu'un administrateur valide sa modification.</p>";
    }
    else{
        if ($idProprio == ModelMembre::getIdByLogin($_SESSION['login'])){
            echo "<p>Vous avez modifié votre service avec succès !</p>";
        }
        else{
            echo "<p>Vous avez modifié le service de ce membre avec succès !</p>";
        }
    }
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=service&action=readAll"> Retour </a>';
?>
<?php
    echo "<p>Message supprimé</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=membre&action=readAll"> Retour </a>';
?>
<?php
    echo "<p>Merci pour votre retour, nous y repondrons des que possible</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=membre&action=readAll"> Retour </a>';
?>
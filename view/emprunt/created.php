<?php
    echo "<p>Votre reservation a bien �t� prise en compte. </p>";
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=bien&action=readAll"> Retour </a>';
?>
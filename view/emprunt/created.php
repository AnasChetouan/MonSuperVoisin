<?php
    echo "<p>Votre reservation a bien été prise en compte. </p>";
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=bien&action=readAll"> Retour </a>';
?>
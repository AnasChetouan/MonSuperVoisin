<?php
    echo "<p>Votre demande a bien été prise en compte ! Le service sera posté lorsqu'un administrateur du site l'aura validé.</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=service&action=readAll"> Retour </a>';
?>
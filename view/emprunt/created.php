<?php
    echo "<p>Votre reservation a bien été prise en compte ! </p>";
    if ($redirection === 'bien'){
        echo "<p> Votre cagnotte a été débitée de ".$prixAPayer."€ correspondant aux ".$nbJours." jours où vous allez emprunter ce bien.";
    }
    if ($redirection === 'service'){
        echo "<p> Votre cagnotte a été débitée de ".$prixAPayer."€ correspondant aux ".$nbH." heures où vous allez utiliser ce service.";
    }
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller='.$redirection.'&action=readAll"> Retour </a>';
?>
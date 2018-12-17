  <p id="text_notif">Réservation effectuée</p>

<?php
    echo "<p>Votre reservation a bien été prise en compte ! </p>";
    if ($redirection === 'bien'){
        echo "<p> Votre solde a été débité de ".$prixAPayer."Voisin-Bucks correspondant aux ".$nbJours." jours où vous allez emprunter ce bien.";
    }
    if ($redirection === 'service'){
        echo "<p> Votre solde a été débité de ".$prixAPayer."Voisin-Bucks correspondant aux ".$nbH." heures où vous allez utiliser ce service.";
    }
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller='.$redirection.'&action=readAll"> Retour </a>';
?>
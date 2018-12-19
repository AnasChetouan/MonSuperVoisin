  <p id="text_notif">Annonce bien reçue</p>
  <div id="cadre_centre">

<?php
    if (!Session::is_admin()){
        echo "<p>Votre demande a bien été prise en compte ! Le bien sera posté lorsqu'un administrateur du site l'aura validé.</p>";
    }
    else{
        echo "<p>Vous avez posté votre nouveau bien avec succès !</p>";
    }
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=service&action=readAll"> Retour </a>';
?>

  </div>
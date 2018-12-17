<p id="text_notif">Commentaire ajouté</p>
<?php
  echo "<p>Votre commentaire a bien été ajouté</p>";;
    require_once File::build_path(array("index.php"));
    if ($typeProduit === "Bien"){
         echo'<a href="index.php?controller=bien&action=readAll"> Revenir en arrière </a>';
    }
    if ($typeProduit === "Service"){
         echo'<a href="index.php?controller=service&action=readAll"> Revenir en arrière </a>';
    }
 ?>
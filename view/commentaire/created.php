<p id="text_notif">Commentaire ajouté</p>
<?php
  echo "<p>Votre commentaire a bien été ajouté</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=bien&action=readAll"> Retour a la liste des biens </a>';
  ?>
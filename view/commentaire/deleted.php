  <p id="text_notif">Commentaire retiré</p>
  <div id="cadre_centre">

<?php
    echo "<p>Le commentaire a bien été supprimé</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=bien&action=readAll"> Retour</a>';
?>

  </div>
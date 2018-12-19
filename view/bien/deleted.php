  <p id="text_notif">Annonce retirée</p>
  <div id="cadre_centre">

<?php
  echo '<p>Cette annonce a bien été retirée du site.</p>';
  require_once File::build_path(array("index.php"));
  echo'<a href="index.php?controller=bien&action=readAll"> Retour </a>';
?>

  </div>

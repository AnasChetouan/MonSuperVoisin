<?php
  echo '<p>Cette annonce a bien �t� retir�e du site.</p>';
  require_once File::build_path(array("index.php"));
  echo'<a href="index.php?controller=bien&action=readAll"> Retour </a>';
?>


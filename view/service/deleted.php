<?php
  echo '<p>Cette annonce a bien été retirée du site.</p>';
  require_once File::build_path(array("index.php"));
  echo'<a href="index.php?controller=service&action=readAll"> Retour </a>';
?>


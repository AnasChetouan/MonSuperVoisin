<?php
  echo '<p>Votre Bien a �t� supprim� </p>';
  require_once File::build_path(array("index.php"));
  echo'<a href="index.php?controller=bien&action=readAll"> Retour </a>';
?>


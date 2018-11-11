<?php
  echo '<p>L\'utilisateur de login <b> ' . $login.' </b> a bien été supprimé </p>';
  require_once File::build_path(array("index.php"));
  echo'<a href="index.php?controller=membre&action=readAll"> Retour </a>';
?>


<?php
  if(Session::is_admin()){
    echo "<p>L'membre a bien été crée !</p>";
    require_once File::build_path(array("view","membre","list.php"));
  }else{
    echo '<div id="text_notif">Confirmez votre compte en cliquant sur le lien que l\'on vous a envoyé sur votre mail et connectez-vous !</div>';
    require_once File::build_path(array("view","membre","connect.php"));
  }
  
?>
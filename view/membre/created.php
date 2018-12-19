<p id="text_notif">Message envoyé</p>
<div id="cadre_centre">

<?php
  if(Session::is_admin()){
    echo "<p>L'utilisateur a bien été crée !</p>";
    require_once File::build_path(array("view","membre","list.php"));
  }else{
    echo '<div id="text_notif">Votre compte est en attente de confirmation par un des administrateurs !</div>';
    require_once File::build_path(array("view","membre","connect.php"));
  }
  
?>
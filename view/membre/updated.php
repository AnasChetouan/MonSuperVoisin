<?php
  if(Session::is_admin()){
    echo "<p>L'utilisateur a bien �t� cr�e !</p>";
    require_once File::build_path(array("view","membre","list.php"));
  }else{
    ControllerMembre::deconnect();
    echo '<div id="text_notif">Votre compte est en attente de confirmation par un des administrateurs !</div>';
    require_once File::build_path(array("view","membre","connect.php"));
  }
  
?>
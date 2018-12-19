<p id="text_notif">Demande d'inscription reçue</p>
<div id="cadre_centre">

<?php
  if(Session::is_admin()){
    echo "<p>L'utilisateur a bien été crée !</p>";
    require_once File::build_path(array("view","membre","list.php"));
  }else{
    ControllerMembre::deconnect();
    echo '<div id="text_notif">Votre compte est en attente de confirmation par un des administrateurs !</div>';
    require_once File::build_path(array("view","membre","connect.php"));
  }
  
?>

</div>
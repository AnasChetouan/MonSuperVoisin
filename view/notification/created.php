<p id="text_notif">Message envoyé</p>
<div id="cadre_centre">

<?php
    echo "<p>Merci pour votre retour, nous y repondrons des que possible</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=membre&action=readAll"> Retour </a>';
?>

 </div>
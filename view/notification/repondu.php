<p id="text_notif">Message envoyé</p>
<div id="cadre_centre">

<?php
    echo "<p>Vous avez répondu à ce message</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=notification&action=readAll"> Retour </a>';
?>

</div>
    
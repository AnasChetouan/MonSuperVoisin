<?php
    echo "<p>Commentaire supprim�</p>";;
    require_once File::build_path(array("index.php"));
    echo'<a href="index.php?controller=bien&action=readAll"> Retour a la liste des biens</a>';
?>
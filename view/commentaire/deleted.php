<p id="text_notif">
    Le commentaire d'id <?=$id?> sur le produit <a href="index.php?controller=<?=$view2?>&action=read&id=<?=$idP?>"><b> d'id <?=$idP?> </b></a>  a bien été supprimée
</p>
<?php
require_once File::build_path(array("view",$view2,"list.php"));
?>
<p id="text_notif">Commentaire ajouté sur <?=$objet?> <a href="index.php?controller=<?=$view2?>&action=read&id=<?=$idP?>"><b>d'id <?=$idP?></b></a></p>
<?php
  require_once File::build_path(array('view',$view2,"list.php"));
  ?>
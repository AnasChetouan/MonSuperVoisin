<p>
Le membre de login <?=$login?> a bien été modifié.
</p>
<?php
if(Session::is_admin()){
  require_once File::build_path(array("view","membre","list.php"));
}else{
  require_once File::build_path(array("index.php"));
}
?>

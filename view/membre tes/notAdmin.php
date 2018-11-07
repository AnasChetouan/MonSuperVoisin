<?php 
  echo '<div id="bloc_erreur_not_admin">
          <h3> La page demandée n\'est pas disponible pour les non administrateurs ! </h3>
          <div id="bloc_signe_erreur"> <img id="icone_erreur" src="./style/img/icone_error.png" alt="icone_erreur"> </div>
        </div>';
  require_once File::build_path(array('index.php'));
  ?>
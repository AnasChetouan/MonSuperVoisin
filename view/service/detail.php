<?php
  $motClef = ($s->getMotClef());
  $descriptionHTML = htmlspecialchars($s->getDescription());
  $tarif = $s->getTarif();
  $dispo = $s->assemblerDispo();
  $idService = ($s->getIdService());
  $idProprio = ($s->getIdProprio());
  $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($idProprio)));
    echo '
           <p><b> Type du service : </b> '.$motClef . '<br> <br>'.
              'Description : </br></br>' . $descriptionHTML .'<br> <br>
              Tarif horaire: <b>'.$tarif . ' </b> € <br> <br>';
              if (isset($_SESSION['login']) && $_SESSION['login'] == ModelMembre::getLoginById($idProprio)){
                  echo '</br><a href="index.php?controller=service&action=update&idService='.$idService.'"> <button>Modifier mon post</button> </a> </br>';
                  echo '</br><a href="index.php?controller=service&action=delete&idService='.$idService.'"> <button>Supprimer mon post</button> </a> </br>';
              }
              if (isset($_SESSION['login']) && $_SESSION['login'] != ModelMembre::getLoginById($idProprio) && Session::is_admin()){ // Un admin peut modifier le bien d'un autre membre
                  echo '</br><a href="index.php?controller=service&action=update&idService='.$idService.'"> <button>Modifier ce post</button></a> </br>';
              }
              echo '</br> Les disponiblités de <b>'.$loginProprio.'</b> pour ce service : </a></br></br>'.nl2br($dispo);
              
              // nl2br sert à prendre en compte les retours à la ligne


              echo '</br></br> <a href="index.php?controller=service&action=readAll"> Retour </a>';

              
           echo '</p>';                         
?>
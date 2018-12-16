<?php
  $motClef = $s->getMotClef();
  $descriptionHTML = htmlspecialchars($s->getDescription());
  $tarif = $s->getTarif();
  $dispo = $s->assemblerDispo();
  $idService = $s->getIdService();
  $idProprio = $s->getIdProprio();
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
   
$hiddenValue="createdService";
           
// On ajoute un jour de + à la date du jour
$today = getdate();
$jour=$today['year'].'-'.$today['mon'].'-'.$today['mday'];
$dateDT = new DateTime($jour.' +1 day');
$date = $dateDT->format('Y-m-d');

if(isset($_SESSION['login']) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
     $cagnotte = ModelMembre::getSoldeByLogin($_SESSION['login']);
    echo '</br>';
    echo '<form method="get" action="index.php">
    <fieldset>
        <legend>Faire recours à ce service</legend>';

if ((intval($cagnotte) - intval($tarif)) < 0 ){
    echo "vous n'avez pas assez de Vbucks";
}
else{ 
        echo '<input type="hidden" name="controller" value="emprunt">
        <input type="hidden" name="action" value="'.$hiddenValue.'">
        <input type="hidden" name="idProduit" value="'.$idService.'">
        <input type="hidden" name="idProprio" value="'.$idProprio.'">
        <input type="hidden" name="cagnotte" value="'.$cagnotte.'">
        <input type="hidden" name="tarif" value="'.$tarif.'">';
        
        echo 'Choisissez une date de réservation pour ce service :
        <input type="date" name="date" min="'.$date.'" value="'.$date.'" required><br><br>';
        
        echo 'Pour : <input type="number" name="nbH" min="1" max="23" value=1 required> H';
        
    echo '
        <p>
            <input type="submit" value="Reserver" />
        </p>';
}
    echo'</fieldset>
</form>';
}

?>
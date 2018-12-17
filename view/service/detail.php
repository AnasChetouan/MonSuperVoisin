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
    echo "Vous n'avez pas assez de Voisin-Bucks";
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

              echo '</br></br> <a href="index.php?controller=service&action=readAll"> Revenir en arrière </a>';

?>

<div id="bloc_all_comm">
    
    
				
				<?php
                                
                                echo '<h2> Liste des commentaires :</h2>';
				if(Session::is_connected() ){
                                        $tab = ModelCommentaire::selectAllCommByIdProduit($idService, "Service");
					if (empty($tab)){
                                            
						echo '<h3> Il n\'y a pas de commentaires pour ce Membre </h3>';
					}else{
                                    
					foreach($tab as $com){
						echo '<fieldset class="commentaire">';
							echo '<div id="bloc_commentaire">';
								echo '<div id="bloc_detail_comm">';
									echo '<b>'.ModelMembre::getLoginById(intval($com->getIdMembre())).'</b> </br></br>';
									echo 'Note : ' . $com->getEtoile() . '/5<br>';
									echo 'Commentaire : ' . $com->getAppreciation() . '<br>';
								echo '</div>';
                					echo '</div>';
						echo '</fieldset>';
          
					}
                                        
                                        
					}
				}else{
					echo '<p> Les commentaires sont visibles seulement si vous etes connecté </p>';
				}
                                
                                    if((isset($_SESSION['login'])) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
                                        echo '</br><a href="index.php?controller=commentaire&action=create&typeProduit=Service&idProduit='.$idService.'"> <button>Ajouter un commentaire</button> </a> </br>';
    }  
                                
					
        ?>
			</div>
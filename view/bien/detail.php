<?php

    

  $descriptionHTML = htmlspecialchars($b->getDescription());
  $titreHTML = htmlspecialchars($b->getTitre());
  $lienPhoto = ($b->getLienPhoto());
  $tarif = ($b->getTarif());
  $prixNeuf = ($b->getPrixNeuf());
  $idBien = ($b->getIdBien());
  $idProprio = ($b->getIdProprio());
  $estDispo = htmlspecialchars($b->getEstDispo());
    echo '
           <p><b> Titre : </b> '.$titreHTML . '<br> <br>'
             .'<img src='.$lienPhoto.' alt="photo bien" height="25%" width="25%" > <br> <br>'.
              'Description : ' . $descriptionHTML .'<br> <br>
              Montant prix d\'achat neuf : <b> ' . $prixNeuf . '</b> € <br>
              Prix d\'emprunt à la journée : <b>'.$tarif . ' </b> € <br> <br>';
              if (isset($_SESSION['login']) && $_SESSION['login'] == ModelMembre::getLoginById($idProprio)){
                  echo '</br><a href="index.php?controller=bien&action=update&id='.$idBien.'"> <button>Modifier mon post</button> </a> </br>';
                  echo '</br><a href="index.php?controller=bien&action=delete&id='.$idBien.'"> <button>Supprimer mon post</button> </a> </br>';
              }
              echo '</br><a href="index.php?controller=bien&action=readAll"> Retour </a>';
              
           echo '</p>';
    if((isset($_SESSION['login'])) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
    echo '</br><a href="index.php?controller=commentaire&action=create&idProduit='.$idBien.'"> <button>Ajouter un commentaire</button> </a> </br>';
    }                               

   ?>
<?php
$formTitle="CrÃ©er";
$hiddenValue="created";
$affId = "hidden";
$visible = "position:absolute;visibility:hidden;";
$date = date('Y-m-d');

if($estDispo == 1 && (isset($_SESSION['login'])) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
    echo '</br>';
echo '<form method="get" action="index.php">
    <fieldset>
        <legend>Reserver</legend>
        <input type="hidden" name="controller" value="emprunt">
        <input type="hidden" name="action" value="'.$hiddenValue.'">
        <input type="hidden" name="idP" value="'.$idBien.'">
        <input type="hidden" name="idmembre" value="'.$idProprio.'">
        <input type="hidden" name="estBien" value="1">
        Du :
        <input type="date" name="dateDebut" min="'.$date.'" value="'.$date.'" required><br>
        Au :
        <input type="date" name="dateFin" min="'.$date.'" required><br>
        <p>
            <input type="submit" value="Reserver" />
        </p>
    </fieldset>
</form>';
}
?>
<div id="bloc_all_comm">
				
				<?php
                                echo '<h2> Liste des commentaires :</h2>';
				if(Session::is_connected() ){
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
					echo '<p> Les commentaires sont visible seulement si vous êtes connecté </p>';
				}
                                
					
        ?>
			</div>

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
              'Description : <br><br>' . $descriptionHTML .'<br> <br>
              Montant prix d\'achat neuf : <b> ' . $prixNeuf . ' € </b> <br>
              Prix d\'emprunt a la journée : <b> '.$tarif . ' Voisin-Bucks </b> <br> <br>';
              if (isset($_SESSION['login']) && $_SESSION['login'] == ModelMembre::getLoginById($idProprio)){
                  echo '</br><a href="index.php?controller=bien&action=update&idBien='.$idBien.'"> <button>Modifier mon post</button> </a> </br>';
                  echo '</br><a href="index.php?controller=bien&action=delete&idBien='.$idBien.'"> <button>Supprimer mon post</button> </a> </br>';
              }
              if (isset($_SESSION['login']) && $_SESSION['login'] != ModelMembre::getLoginById($idProprio) && Session::is_admin()){ // Un admin peut modifier le bien d'un autre membre
                  echo '</br><a href="index.php?controller=bien&action=update&idBien='.$idBien.'"> <button>Modifier ce post</button></a> </br>';
              }
          
           echo '</p>';                             
   ?>

<?php

   
$formTitle="Creer";
$hiddenValue="createdBien";
$affId = "hidden";
$visible = "position:absolute;visibility:hidden;";

// On ajoute un jour de + à la date du jour
$today = getdate();
$jour=$today['year'].'-'.$today['mon'].'-'.$today['mday'];
$dateDT = new DateTime($jour.' +1 day');
$date = $dateDT->format('Y-m-d');

if($estDispo == 1 && (isset($_SESSION['login'])) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
     $cagnote = ModelMembre::getSoldeByLogin($_SESSION['login']);
    echo '</br>';
echo '<form method="get" action="index.php">
    <fieldset>
        <legend>Reserver</legend>';

if ((intval($cagnote) - intval($tarif)) < 0 ){
    echo "Vous n'avez pas assez de Voisin-Bucks pour réserver ce bien";
}
else{
    echo' 
        <input type="hidden" name="controller" value="emprunt">
        <input type="hidden" name="action" value="'.$hiddenValue.'">
        <input type="hidden" name="idP" value="'.$idBien.'">
        <input type="hidden" name="idmembre" value="'.$idProprio.'">
        <input type="hidden" name="cagnote" value="'.$cagnote.'">
        <input type="hidden" name="tarif" value="'.$tarif.'">
        <input type="hidden" name="estBien" value="1">
        Du :
        <input type="date" name="dateDebut" min="'.$date.'" value="'.$date.'" required><br>
        Au :
        <input type="date" name="dateFin" min="'.$date.'" required><br>';
        
    echo '
        <p>
            <input type="submit" value="Reserver" />
        </p>';
}
    echo'</fieldset>
</form>';
    
     
}

echo '</br><a href="index.php?controller=bien&action=readAll"> Revenir en arrière </a>';
?>
<div id="bloc_all_comm">
    
    
				
				<?php
                                
                                echo '<h2> Liste des commentaires :</h2>';
				if(Session::is_connected() ){
                                    $tab = ModelCommentaire::selectAllCommByIdProduit($idBien, "Bien");
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
                                        echo '</br><a href="index.php?controller=commentaire&action=create&typeProduit=Bien&idProduit='.$idBien.'"> <button>Ajouter un commentaire</button> </a> </br>';
    }  
                                
					
        ?>
			</div>

<?php
  $motClef = $s->getMotClef();
  $descriptionHTML = htmlspecialchars($s->getDescription());
  $tarif = $s->getTarif();
  $tab_d = $s->assemblerDispo();
  $idService = $s->getIdService();
  $idProprio = $s->getIdProprio();
  $tab_r = $s->getReservations();
  $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($idProprio)));
    echo '<div id="detailBien">
            <div id="detailBien1">
           <p><b> Type du service : </b> '.$motClef . '<br> <br>'.
              'Description : </br></br>' . $descriptionHTML .'<br> <br>
              Tarif horaire: <b>'.$tarif . ' </b> Voisins-bucks <img src="style/img/VBucks.png" alt="photo bien" height="2%" width="2%" ><br> <br>';
              if (isset($_SESSION['login']) && $_SESSION['login'] == ModelMembre::getLoginById($idProprio)){
                  echo '</br><a href="index.php?controller=service&action=update&idService='.$idService.'"> <button>Modifier mon post</button> </a> </br>';
                  echo '</br><a href="index.php?controller=service&action=delete&idService='.$idService.'"> <button>Supprimer mon post</button> </a> </br>';
              }
              if (isset($_SESSION['login']) && $_SESSION['login'] != ModelMembre::getLoginById($idProprio) && Session::is_admin()){ // Un admin peut modifier le bien d'un autre membre
                  echo '</br><a href="index.php?controller=service&action=update&idService='.$idService.'"> <button>Modifier ce post</button></a> </br>';
              }
              
                    echo '<table>
               <caption>Disponibilités de '.$loginProprio.' pour ce service</caption>
               <tr>
                   <th>Jour</th>
                   <th>Heure de début</th>
                   <th>Heure de fin</th>
               </tr>';
                foreach($tab_d as $d){
                    $heureDebut = $d['heureDebut'];
                    $heureFin = $d['heureFin'];
                    if ($heureDebut == 0){
                        $heureDebut = 'Minuit';
                    }
                    if ($heureFin == 0){
                        $heureFin = 'Minuit';
                    }
                    echo '<tr>
                        <td>'.$d['nomJour'].'</td>
                        <td>'.$heureDebut.'</td>
                        <td>'.$heureFin.'</td>
                    </tr>';
                }

            echo '</table>';

              
           echo '</p> </div>';                         
   
$hiddenValue="createdService";
           
// On ajoute un jour de + à la date du jour
$today = getdate();
$jour=$today['year'].'-'.$today['mon'].'-'.$today['mday'];
$dateDT = new DateTime($jour.' +1 day');
$date = $dateDT->format('Y-m-d');
    echo '<div id="detailBien1">';
if(isset($_SESSION['login']) && ($_SESSION['login'] != ModelMembre::getLoginById($idProprio))){
        if(!empty($tab_r)){
            echo '<table>
               <caption>Réservations pour ce service :</caption>
               <tr>
                   <th>Réservé par </th>
                   <th>Date de réservation</th>
               </tr>';
                foreach($tab_r as $r){
                    $db = $r["dateDebut"];
                    $dateDT = new DateTime($db);
                    $dateDeb = $dateDT->format('d-m-Y');
                    
                    echo '<tr>
                        <td>'.ModelMembre::getLoginByid($r['idAcceptant']).'</td>
                        <td>'.$dateDeb.'</td>
                    </tr>';
                }

            echo '</table>';
        }
        else{
            echo 'Ce service n\'a pas encore été utilisé.<br>';
        }
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
 echo '</div>';       
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
                                                                         if(Session::is_admin()){
                                                                        echo 'Supprimer <a href="index.php?controller=commentaire&action=delete&idC='.$com->getIdComm().'"><img src="style/img/icone_deconnect.png" alt="supression du commentaire"></a>';
                                                                        }
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
                                
				 echo '</div>';       	
        ?>
			</div>

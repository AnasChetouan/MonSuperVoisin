<?php
require_once File::build_path(array("controller","ControllerCommentaire.php"));


  $loginHTML = htmlspecialchars($u->getLogin());
  $nomHTML = htmlspecialchars($u->getNom());
  $prenomHTML = htmlspecialchars($u->getPrenom());
  $loginURL = rawurlencode($u->getLogin());
  $emailHTML = htmlspecialchars($u->getmail());
  $adminHTML = htmlspecialchars($u->getAdmin());
  $cagnotte = $u->getSolde();
  
  if($u->getAdmin()){
    $reponse = 'Oui';
  }
  else{ 
    $reponse= 'Non';
  }
 echo '
        <p>Utilisateur de login <b>'. $loginHTML .'</b><br>
           Prénom : '.$prenomHTML. '<br>
           Nom : '.$nomHTML . '<br>
           Email : ' . $emailHTML .'<br>
           Administrateur : ' . $reponse .'<br> 
           Cagnotte : ' . $cagnotte .'<b> €</b> <br>
           <a href="index.php?controller=membre&action=readAll"> Retour </a>
        </p>';
 /*<a href="index.php?controller=membre&action=delete&login='.$loginURL.'" title="Supprimer">'.'</a><br>
            <a href="index.php?controller=membre&action=update&login='.$loginURL.'" title="Modifier">'.'</a> */
?>
<div id="bloc_all_comm">
				
				<?php
                                if(!empty(Dispatcher::myGet('idMembre'))){
                                    
                                    //echo '<a href="index.php?controller=Commentaire&action=create"> <button>Ajouter un commentaire</button> </a> </br>';
                                        
                                    
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
                                }
					
        ?>
			</div>
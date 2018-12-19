<?php
require_once File::build_path(array("controller","ControllerCommentaire.php"));


  $loginHTML = htmlspecialchars($u->getLogin());
  $nomHTML = htmlspecialchars($u->getNom());
  $prenomHTML = htmlspecialchars($u->getPrenom());
  $loginURL = rawurlencode($u->getLogin());
  $emailHTML = htmlspecialchars($u->getmail());
  $adminHTML = htmlspecialchars($u->getAdmin());
  $solde = $u->getSolde();
  

 echo '
        <p> Utilisateur de login <b>'. $loginHTML .'</b><br>';
            echo'<div id="infos_user">';
            echo '<b>Informations Utilisateur :</b><br>'
            . '<br>';

            echo 'Prénom : '.$prenomHTML. '<br>
            Nom : '.$nomHTML . '<br>
            Email : ' . $emailHTML .'<br>';
            
             echo'</div>';
            if((isset($_SESSION['login']) && $_SESSION['login'] == $loginHTML) || Session::is_admin()){
             echo'<div id="infos_user">';
            echo '<b>Informations du compte :</b><br>'
            . '<br>';
            if($u->getAdmin()){
             echo 'Type de compte : Administrateur<br>';
            }
            else{ 
              echo 'Type de compte : Particulier<br>';
             }
            echo 'Solde : ' . $solde .' Voisin-Bucks <b> </b> <img src="style/img/VBucks.png" alt="vbucks" height="2%" width="2%" > <br> <br> ';
           }
           echo'</div>'
           
 /*<a href="index.php?controller=membre&action=delete&login='.$loginURL.'" title="Supprimer">'.'</a><br>
            <a href="index.php?controller=membre&action=update&login='.$loginURL.'" title="Modifier">'.'</a> */
?>

    <?php 
    if(ucfirst($loginHTML) == ucfirst($_SESSION['login'])){
        echo '<div id="actions_user">';
        echo '</br>';
        echo '<a href="index.php?controller=membre&action=update&login='.$loginURL.'" title="Modifier">'.'<button>Modifier mon profil</button></a>';
        echo '</br>';
        echo '<a href="index.php?controller=emprunt&action=listeEmpruntByMembre&login='.$loginURL.'" title="liste emprunts">'.'<button>Voir ma liste d\'emprunts</button></a>';
        echo '</br>';
        echo '<a href="index.php?controller=bien&action=readAllByMembre&login='.$loginURL.'" title="liste biens">'.'<button>Voir ma liste de Biens</button></a>';
        echo '</br>';
        echo '<a href="index.php?controller=service&action=readAllByMembre&login='.$loginURL.'" title="liste services">'.'<button>Voir ma liste de Services</button></a>';
        
        echo '</div>';
        
    }
     echo '<br><a href="index.php?controller=accueil&action=accueil"> Accueil </a></p>';
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
									echo 'Note : ' . $com->getEtoile() . '/5  </br> Pour le ';
                                                                        if($com->getestBien() == 1){
                                                                            echo "bien : ";
                                                                            echo '<a href="index.php?controller=bien&action=read&idBien='.$com->getIdProduit().'">'.ModelBien::select($com->getIdProduit())->getTitre().'</a>';
                                                                            echo "</br>";
                                                                        }else {
                                                                            echo "service : ";
                                                                            echo '<a href="index.php?controller=service&action=read&idService='.$com->getIdProduit().'">'.ModelService::select($com->getIdProduit())->getMotClef().'</a>';
                                                                            echo "</br>";
                                                                        }
                                                                        
									echo 'Commentaire : ' . $com->getAppreciation() . '<br>';
								echo '</div>';
                					echo '</div>';
						echo '</fieldset>';
          
					}                                       
					}
				}else{
					echo '<p> Les commentaires sont visible seulement si vous etes connectés </p>';
				}
                                }
					
        ?>
			</div>
<?php 
					$id=$v->getIdVelo();
					$image =$v->getAdresseImage();
					$nom = $v->getNomVelo();
					$prix = $v->getPrix();
					$taille = $v->getTailleVelo();
					$quantite = $v->getQuantiteStock();
					$categorie = $v->getidCategorie();
					$tab_semblables = ModelVelo::getProduitsSemblables($categorie);
?>
<!DOCTYPE html>
	<html>
		
		<body>
			
				<div id="bloc_produit">
					<div id="bloc_gauche">
						<div id="bloc_image_produit">
					 		<img id="image_produit" src="<?=$image?>" alt="image_produit" />
					 	</div>
					 	<div id="bloc_nom_produit">
					 		<h3> <?=$nom?> </h3>
					 	</div>
				 	</div>
				 	<div id="bloc_droit">
				 		<div id="bloc_prix">
				 			<h2> <?=$prix?>€ </h2>
				 		</div>
				 		<div id="bloc_taille">
				 			<p> Taille du vélo : <?=$taille?></p>
				 		</div>
				 		<div id="bloc_quantite">
				 			<p> Quantité encore en stock : <?=$quantite?></p>
				 		</div>
				 		<div id="bloc_ajout_panier">
				 			<a href="index.php?controller=utilisateur&action=addPanier&nom=<?php echo $nom ?>&prix=<?php echo $prix ?>&qte=1"> <!-- implémenter cette action avec un if qui verifie si le visiteur est connecte ou pas -->
				 				<p> Ajouter au panier</p>
				 			</a>
				 		</div>
				 		<?php if(Session::is_admin()){ //bloc s'affichant que si le 	visiteur est connecté et admin
				 					echo '<div id="bloc_modif_produit">
						 							<a href="index.php?controller=velo&action=update&id='.$id.'">
						 								<p> Modifier le produit </p>
						 							</a>
						 						</div>';
						 			echo '<div id="bloc_suppr_produit">
						 						 	<a href="index.php?controller=velo&action=delete&id='.$id.'">
						 						 		<p> Supprimer le produit </p>
						 						 	</a>
						 						 </div>';
				 					}
				 		?>
				 		
				 		</div>
				 	</div>
			<div id="bloc_article_semblable">
				<div id="titre_article_semblable">
					<p> Articles semblables :</p>
				</div>
				<div id="articles_semblable">
					<!-- IL FAUT AFFICHER TOUS LES PRODUITS SEMBLABLES (ceux qui sont présent dans $tab_semblables initialisé au debut du fichier) -->
				</div>
			</div>
			<?php
				if(Session::is_connected()){
					echo '
			
			<div id="bloc_add_comm">
				<form method="get" action="index.php">
					<fieldset>
						<legend>Rédiger un avis :</legend>
			        <input type="hidden" name="controller" value="commentaire">
			        <input type="hidden" name="action" value="created">
			        <p>
		            <p>Appréciation général sur le produit (note sur 5):</p>
		            <input class="boutons_radio" type="radio" name="appreciation" value="0" checked/> 0
		            <input class="boutons_radio" type="radio" name="appreciation" value="1" /> 1
		            <input class="boutons_radio" type="radio" name="appreciation" value="2" /> 2
		            <input class="boutons_radio" type="radio" name="appreciation" value="3" /> 3
		            <input class="boutons_radio" type="radio" name="appreciation" value="4" /> 4
		            <input class="boutons_radio" type="radio" name="appreciation" value="5" /> 5
        			</p>
			        <p class="bloc_ecrire">
			            <label for="comm_id">Partagez votre avis</label>
			            <textarea selectionEnd name="comm" id="comm_id"  rows=8 cols=50 required>
			            </textarea>
			        </p>
			    
			      	
			      <p id="bloc_id_produit">
			            <label for="id_id">Id du produit</label>
			            <input name="idP" id="id_id" value="'.$id.'" readonly/>
			        </p>
			        <input type="submit" value="Partagez">
					</fieldset>
				</form>
			</div>
			';
				}
			?>
			<div id="bloc_all_comm">
				<h2> Liste des commentaires :</h2>
				<?php
					if (empty($tab_com)){
						echo '<h3> Il n\'y a pas de commentaires sur ce produit </h3>';
					}
					foreach($tab_com as $com){
						echo '<fieldset class="commentaire">';
							echo '<div id="bloc_commentaire">';
								echo '<div id="bloc_detail_comm">';
									echo '<b>'.$com->getLoginU().'</b> <br>';
									echo 'Appréciation : ' . $com->getAppreciation() . '/5<br>';
									echo 'Commentaire : ' . $com->getCommentaire() . '<br>';
								echo '</div>';
                                                                if(Session::is_admin()){
                                                                    echo '<div id="bloc_suppr_comm">';
                                                                            echo '<div id="bouton_suppr_comm">';
                                                                                    echo '<a href="index.php?controller=commentaire&action=delete"><p>Supprimer</p></a>';
                                                                            echo '</div>';
                                                                    echo '</div>';
                                                                }
							echo '</div>';
						echo '</fieldset>';
          
					}
					
        ?>
			</div>
			

			
			
	
		
	</body>
	</html>

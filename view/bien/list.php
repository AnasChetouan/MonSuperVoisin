<div class="produits">
    
    <?php
    if(!empty($_SESSION['login'])){
        $ville = " près de ".ModelMembre::getVilleByLogin($_SESSION['login']);
    }
    else $ville = "";
    
    echo '
        <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="Bien">
        <input type="hidden" name="action" value="rechercheBien">
                 <div id="recherche"> Rechercher un bien'.$ville.' :
                      <input type="text" name="nom" required placeholder="Exemple : Souris" />
                      </br>
                       </br>
                      Entre : 
                      <input type="number" name="prix1" min="0" placeholder=0> Voisin-Bucks et 
                      <input type="number" name="prix2" min="0" placeholder=100> Voisin-Bucks
                      </br>
                      </br>
                 <input type="submit" value="Rechercher" />
                 </div> 
        </form>  
        </br>';          
    
    if(empty($_SESSION['login'])){
        echo '<a <button href="index.php?controller=membre&action=create" style="margin-left:35%;" class="w3-button w3-xlarge w3-theme w3-hover-teal" title="S\'inscrire">Inscrivez-vous dès maintenant !</button></a><br>';
    }
        foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            $lienPhoto = htmlspecialchars($b->getLienPhoto());
            $idBien = htmlspecialchars($b->getIdBien());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($b->getIdProprio())));
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idBien, "Bien");
            $estDispo = htmlspecialchars($b->getEstDispo());
            $estValide = htmlspecialchars($b->getEstValide());
            if(($estDispo == 1) &&($estValide == 1)){
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src='.$lienPhoto.' alt="photo bien" height="50%" width="50%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            if (!empty($tabNotes)){
	            for ($i = 0; $i< 5 ; $i++) {
	                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idBien, "Bien"))){
	                echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
	                }
	                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
	                }
            }
            else{
            	echo '<b>Pas encore noté </b>'.'<br/>';
            }
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo 'Propriétaire : '.$loginProprio;
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=bien&action=read&idBien='.$idBien.'"><button> Detail objet </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
    ?>
</div>

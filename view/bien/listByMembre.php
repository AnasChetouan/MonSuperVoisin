<div class="produits">
    
    <?php            
        foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            $lienPhoto = htmlspecialchars($b->getLienPhoto());
            $idBien = htmlspecialchars($b->getIdBien());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($b->getIdProprio())));
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idBien);
            $estDispo = htmlspecialchars($b->getEstDispo());
            $estValide = htmlspecialchars($b->getEstValide());
            if(($estValide == 1) && (($b->getIdProprio()) == ModelMembre::getIdByLogin($_SESSION['login']))){
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src='.$lienPhoto.' alt="photo bien" height="50%" width="50%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            if (!empty($tabNotes)){
	            for ($i = 0; $i< 5 ; $i++) {
	                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idBien))){
	                echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
	                }
	                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
	                }
            }
            else{
            	echo '<b>Pas encore not� </b>'.'<br/>'.'<br/>';
            }
            
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=bien&action=read&idBien='.$idBien.'"><button> Detail objet </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
    ?>
</div>

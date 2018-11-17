<div class="produits">
    
    <?php
        foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            $descHTML = htmlspecialchars($b->getDescription());
            $lienPhoto = htmlspecialchars($b->getLienPhoto());
            $idBien = htmlspecialchars($b->getIdBien());
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src='.$lienPhoto.' alt="photo bien" height="50%" width="50%" ></b>'.'<br/>  </p>';
            echo '<br/> <p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            for ($i = 0; $i< 5 ; $i++) {
                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idBien))){
                echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
                }
                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
                }
            
            echo '<br/> <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo '<a href="index.php?controller=bien&action=read&id='.$idBien.'"> Detail objet </a>';
            echo '</div>';
            echo '</a>';
        }
    ?>
</div>
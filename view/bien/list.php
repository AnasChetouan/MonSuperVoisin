<div class="produits">
    
    <?php
        foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            $descHTML = htmlspecialchars($b->getDescription());
            echo '<div class="produit">';
            echo '<br/> <p>'.'<b>'.'Lien vers la photo à rajouter'.'</b>'.'<br/>  </p>';
            echo '<br/> <p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            echo '<br/> <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo '</div>';
            echo '</a>';
        }
    ?>
</div>
<div class="produits">
    
    <?php
        foreach($tab_b as $b){ 
            $id = ($b->getIdBien());
            $titreHTML = htmlspecialchars($b->getTitre());
            $descHTML = htmlspecialchars($b->getDescription());
            $tarif = ($b->getTarif());
            $lienPhoto = ($b->getLienPhoto());
            
            echo '<div class="produit">';
            echo '<img src='.$lienPhoto.' alt="photo bien" >';
            echo '<br/> <p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            echo 'Tarif : '.$tarif.' € la journée'.'</b>'.'<br/>  </p>';
            echo '<a href="index.php?controller=bien&action=read&id='.$id.'"> Voir en détail </a>';
            echo '</div>';
        }
    ?>
</div>
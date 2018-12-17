<div class="produits">
    
    <?php            
        foreach($tab_s as $s){ 
            $titreHTML = htmlspecialchars($s->getMotClef());
            $idService = htmlspecialchars($s->getIdService());
            $estValide = htmlspecialchars($s->getEstValide());
            if(($estValide == 1) && (($s->getIdProprio()) == ModelMembre::getIdByLogin($_SESSION['login']))){
            echo '<div class="produit">';
            echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Detail service </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
    ?>
</div>

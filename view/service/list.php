<div class="produits">
    
    <?php
        foreach($tab_s as $s){ 
            $idService = htmlspecialchars($s->getIdService());
            $motClef = htmlspecialchars($s->getMotClef());
            $tarif = htmlspecialchars($s->getTarif());
            $estValide = htmlspecialchars($s->getEstValide());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($s->getIdProprio())));
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src="style/img/service.png" alt="photo service" height="40%" width="60%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$motClef.'</b>'.'<br/>  </p>';
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo 'Propriétaire : '.$loginProprio;
            echo '<br/>'.'<br/>'.'Tarif horaire : '.$tarif." €";
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Plus d\'infos </button></a>';
            echo '</div>';
            echo '</a>';
        }
    ?>
</div>

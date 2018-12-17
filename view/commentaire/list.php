<div class="produits">
    
    <?php
        foreach($tab_c as $c){
            $idCommHTML = htmlspecialchars($c->getIdComm());
            $idCommURL = rawurlencode($c->getIdComm());
        
            switch($idSousCategorie){
                case "Velo":
                    $v = ModelVelo::select($c->getIdProduit());
                    $adresseImgProduitHTML = htmlspecialchars($v->getAdresseImage());
                    break;
                case "Accessoire":
                    $a = ModelAccessoire::select($c->getIdProduit());
                    $adresseImgProduitHTML = htmlspecialchars($a->getAdresseImage());
                    break;
                case "PieceDetache":
                    $p = ModelPieceDetache::select($c->getIdProduit());
                    $adresseImgProduitHTML = htmlspecialchars($p->getAdresseImage());
                    break;
                    
            }
            
           echo '<div class="produit">';
            echo '<p>'.'<p><b> '.$c->getLoginU().' </b></p>'.'Appréciation : <b><br/>'.$c->getAppreciation().'/5</b>'.'<br/> Commentaire : '.$c->getCommentaire().'  </p> <br/>';
        	echo '<img src="'.$adresseImgProduitHTML.'" alt="texte alternatif" >';
            echo '</div>';
        } 
    ?>
</div>


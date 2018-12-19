<div class="produits">
    
    <?php
            $aUnBien = false;
            foreach($tab_b as $b){ 
                $titreHTML = htmlspecialchars($b->getTitre());
                $lienPhoto = htmlspecialchars($b->getLienPhoto());
                $idBien = htmlspecialchars($b->getIdBien());
                $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($b->getIdProprio())));
                $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idBien, "Bien");
                //$estDispo = htmlspecialchars($b->getEstDispo());
                $estValide = htmlspecialchars($b->getEstValide());
                if(($estValide == 1) && (($b->getIdProprio()) == ModelMembre::getIdByLogin($_SESSION['login']))){
                    $aUnBien = true;
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
                            echo '<b>Pas encore noté </b>'.'<br/>'.'<br/>';
                        }
                    echo '<br/>'.'<br/>'.'<a href="index.php?controller=bien&action=read&idBien='.$idBien.'"><button> Detail objet </button></a>';
                    echo '</div>';
                    echo '</a>';
                }
            }
       if(!$aUnBien){
            echo '<div id="cadre_centre"> <p> Vous n\'avez pas encore posté de bien ou alors il n\'a pas encore été validé par un administrateur !</p> </div>';
        }
    ?>
</div>
<div class="produits">
    <br>
    <?php           
    $aUnService = false;
        foreach($tab_s as $s){ 
            $titreHTML = htmlspecialchars($s->getMotClef());
            $idService = htmlspecialchars($s->getIdService());
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idService, "Service");
            $estValide = htmlspecialchars($s->getEstValide());
            if(($estValide == 1) && (($s->getIdProprio()) == ModelMembre::getIdByLogin($_SESSION['login']))){
                $aUnService = true;
                echo '<div class="produit">';
                echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
                     if (!empty($tabNotes)){
                                for ($i = 0; $i< 5 ; $i++) {
                                    if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idService, "Service"))){
                                    echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
                                    }
                                    else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
                                    }
                        }
                        else{
                            echo '<b>Pas encore noté </b>'.'<br/>'.'<br/>';
                        }
                echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Detail service </button></a>';
                echo '</div>';
                echo '</a>';
            }
        }
        if(!$aUnService){
            echo '<p> Vous n\'avez pas encore posté de service ou alors il n\'a pas encore été validé par un administrateur !</p>';
        }
    ?>
</div>

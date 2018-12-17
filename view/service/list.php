<div class="produits">
    
    <?php
    
        if(!empty($_SESSION['login'])){
            $ville = " pres de ".ModelMembre::getVilleByLogin($_SESSION['login']);
        }
        else $ville = "";
    
    echo '
        <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="Service">
        <input type="hidden" name="action" value="rechercheService">
                 <div id="recherche"> Rechercher un Service'.$ville.' :
                      <input type="text" name="nom" required placeholder="Exemple : Babysitting" />
                      </br>
                      Entre : 
                      <input type="number" name="prix1" min="0" placeholder=0> € et 
                      <input type="number" name="prix2" min="0" placeholder=100> € / heures
                      </br>
                      </br>
                 <input type="submit" value="Rechercher" />
                 </div> 
        </form>  
        </br>';          
        foreach($tab_s as $s){ 
            $idService = htmlspecialchars($s->getIdService());
            $motClef = htmlspecialchars($s->getMotClef());
            $tarif = htmlspecialchars($s->getTarif());
            $estValide = htmlspecialchars($s->getEstValide());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($s->getIdProprio())));
            if($estValide == 1){
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src="style/img/service.png" alt="photo service" height="40%" width="60%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$motClef.'</b>'.'<br/>  </p>';
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo 'Propriétaire : '.$loginProprio;
            echo '<br/>'.'<br/>'.'Tarif horaire : '.$tarif." â‚¬";
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Plus d\'infos </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
    ?>
</div>

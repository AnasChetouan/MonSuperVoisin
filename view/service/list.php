<div class="produits">
    
    <?php
    
        if(!empty($_SESSION['login'])){
            $ville = " près de ".ModelMembre::getVilleByLogin($_SESSION['login']);
        }
        else $ville = "";
    
    echo '
        <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="Service">
        <input type="hidden" name="action" value="rechercheService">
                 <div id="recherche"> Rechercher un service'.$ville.' :
                      <input type="text" name="nom" required placeholder="Exemple : Babysitting" />
                      </br>
                      Entre : 
                      <input type="number" name="prix1" min="0" placeholder=0> Voisin-Bucks et 
                      <input type="number" name="prix2" min="0" placeholder=100> Voisin-Bucks / heure
                      </br>
                      </br>
                 <input type="submit" value="Rechercher" />
                 </div> 
        </form>  
        </br>';   
    
    if(empty($_SESSION['login'])){
        echo '<a <button href="index.php?controller=membre&action=create" style="margin-left:35%;" class="w3-button w3-xlarge w3-theme w3-hover-teal" title="S\'inscrire">Inscrivez-vous dès maintenant !</button></a><br>';
    }
        foreach($tab_s as $s){ 
            $idService = htmlspecialchars($s->getIdService());
            $motClef = htmlspecialchars($s->getMotClef());
            $tarif = htmlspecialchars($s->getTarif());
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idService,"Service");
            $estValide = htmlspecialchars($s->getEstValide());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($s->getIdProprio())));
            if($estValide == 1){
            echo '<div class="produit">';
            echo '<br/> <p> <b><img src="style/img/service.png" alt="photo service" height="40%" width="60%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$motClef.'</b>'.'<br/>  </p>';
            if (!empty($tabNotes)){
	            for ($i = 0; $i< 5 ; $i++) {
	                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idService, "Service"))){
	                echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
	                }
	                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
	                }
            }
            else{
            	echo '<b>Pas encore noté </b>';
            }
            
            echo 'Propriétaire : '.$loginProprio.'<br>';
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            
            echo '<br/>'.'Tarif horaire : '.$tarif." €";
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Plus d\'infos </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
    ?>
</div>

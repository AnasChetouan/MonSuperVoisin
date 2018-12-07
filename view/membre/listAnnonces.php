
<div class="produits">
    
    <?php
       if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&Session::is_admin()==true){
           
           foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            //$descHTML = htmlspecialchars($b->getDescription());
            $lienPhoto = htmlspecialchars($b->getLienPhoto());
            $idBien = htmlspecialchars($b->getIdBien());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($b->getIdProprio())));
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idBien);
            $estDispo = htmlspecialchars($b->getEstDispo());
            $estValide = htmlspecialchars($b->getEstValide());
            
            echo '<div class="produit">';
            if(($estDispo == 0)){
                echo "en cours d'emprunt";
            }
            else {
                echo 'Suppression  <a href="index.php?controller=Bien&action=delete&idBien='.$idBien.'"><img src="style/img/icone_deconnect.png" alt="supression du Bien" style="width:10%;height:10%"></a>';
                echo '</br>';
                if($estValide==1){
                echo 'Validation  <a href="index.php?controller=bien&action=validate&idBien='.$idBien.'"><img src="style/img/validate.jpg" alt="validation annonce" style="width:10%;height:10%"></a>';
                }
                else echo 'Validation <a href="index.php?controller=bien&action=desactiver&idBien='.$idBien.'"><img src="style/img/ban.jpg" alt="Bannissement tempo annonce" style="width:10%;height:10%"></a>';
                
                
            }
            echo '<br/> <p> <b><img src='.$lienPhoto.' alt="photo bien" height="50%" width="50%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            if (!empty($tabNotes)){
	            for ($i = 0; $i< 5 ; $i++) {
	                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idBien))){
	                echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
	                }
	                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
	                }
            }
            else{
            	echo '<b>Pas encore noté </b>'.'<br/>'.'<br/>';
            }
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo 'Propriétaire : '.$loginProprio;
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=bien&action=read&id='.$idBien.'"><button> Detail objet </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
        
        else echo "Cette Page n'est pas disponible pour les utilisateurs"
        
        
        
    ?>
    
</div>
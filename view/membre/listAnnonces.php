
<div class="produits">
    
    <?php
       if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&Session::is_admin()==true){
           
           foreach($tab_b as $b){ 
            $titreHTML = htmlspecialchars($b->getTitre());
            //$descHTML = htmlspecialchars($b->getDescription());
            $lienPhoto = htmlspecialchars($b->getLienPhoto());
            $idBien = htmlspecialchars($b->getIdBien());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($b->getIdProprio())));
            $tabNotes = ModelCommentaire::selectAllCommByIdProduit($idBien,"Bien");
            //$estDispo = htmlspecialchars($b->getEstDispo());
            $estValide = htmlspecialchars($b->getEstValide());
            
            echo '<div class="produit">';
            //if(($estDispo == 0)){
            //    echo "en cours d'emprunt";
            //}
                echo 'Suppression  <a href="index.php?controller=Bien&action=delete&idBien='.$idBien.'"><img src="style/img/icone_deconnect.png" alt="supression du Bien" style="width:10%;height:10%"></a>';
                echo '</br>';
                if($estValide==0){
                echo 'Validation  <a href="index.php?controller=bien&action=validate&idBien='.$idBien.'"><img src="style/img/validate.jpg" alt="validation annonce" style="width:10%;height:10%"></a>';
                }
                else echo 'Validation <a href="index.php?controller=bien&action=desactiver&idBien='.$idBien.'"><img src="style/img/ban.jpg" alt="Bannissement tempo annonce" style="width:10%;height:10%"></a>';
                
               
            echo '<br/> <p> <b><img src='.$lienPhoto.' alt="photo bien" height="50%" width="50%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$titreHTML.'</b>'.'<br/>  </p>';
            if (!empty($tabNotes)){
	            for ($i = 0; $i< 5 ; $i++) {
	                if($i < intval(ModelCommentaire::getNoteMoyenneByIdProduit($idBien,"Bien"))){
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
            
            foreach($tab_s as $s){ 
            $idService = htmlspecialchars($s->getIdService());
            $motClef = htmlspecialchars($s->getMotClef());
            $tarif = htmlspecialchars($s->getTarif());
            $estValide = htmlspecialchars($s->getEstValide());
            $loginProprio = htmlspecialchars(ModelMembre::getLoginById(($s->getIdProprio())));
                
            echo '<div class="produit">';
            
             echo 'Suppression  <a href="index.php?controller=service&action=delete&idService='.$idService.'"><img src="style/img/icone_deconnect.png" alt="supression du Bien" style="width:10%;height:10%"></a>';
                echo '</br>';
                if($estValide==0){
                echo 'Validation  <a href="index.php?controller=service&action=validate&idService='.$idService.'"><img src="style/img/validate.jpg" alt="validation annonce" style="width:10%;height:10%"></a>';
                }
                else echo 'Validation <a href="index.php?controller=service&action=desactiver&idService='.$idService.'"><img src="style/img/ban.jpg" alt="Bannissement tempo annonce" style="width:10%;height:10%"></a>';
                
            
            echo '<br/> <p> <b><img src="style/img/service.png" alt="photo service" height="40%" width="60%" ></b>'.'<br/>  </p>';
            echo '<p>'.'<b>'.$motClef.'</b>'.'<br/>  </p>';
            
            // <p>'.'<b>'.$descHTML.'</b>'.'<br/>  </p>';
            echo 'Propriétaire : '.$loginProprio;
            echo '<br/>'.'<br/>'.'Tarif horaire : '.$tarif." €";
            echo '<br/>'.'<br/>'.'<a href="index.php?controller=service&action=read&idService='.$idService.'"><button> Plus d\'infos </button></a>';
            echo '</div>';
            echo '</a>';
            }
        }
        
        else echo "Cette Page n'est pas disponible pour les utilisateurs"
        
        
        
    ?>
    
</div>
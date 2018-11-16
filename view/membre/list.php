
<div class="produits">
    
    <?php
       if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&Session::is_admin()==true){
            echo '<span class="ajout">
                    <a href="index.php?controller=membre&action=create">
                        <img src="style/img/add2.png" alt="image d\'ajout">
                        <p>
                            Ajouter un membre
                        </p>
                    </a>
                </span>';
            
        }
        foreach($tab_u as $u){ 
            $loginHTML = htmlspecialchars($u->getLogin());
            $idLoginURL = rawurlencode($u->getLogin());
            $nomHTML = htmlspecialchars($u->getNom());
            $idMembre = htmlspecialchars($u->getIdMembre());
            //$nbrEtoile =  htmlspecialchars($u->getNom());
            echo '<a href="index.php?controller=membre&action=read&login='.$loginHTML.'&idMembre='.$idMembre.'">';
            echo '<div class="produit">';
            echo '<img src="style/img/profil.png" alt="image profil" >';
             if(isset($_SESSION['admin']) && Session::is_admin()==true){
                echo '<a href="index.php?controller=membre&action=delete&login='.$loginHTML.'"><img src="style/img/icone_deconnect.png" alt="supression utilisateur" style="width:10%;height:10%"></a>';
                if($u->getNonce()==1){
                echo '<a href="index.php?controller=membre&action=validate&login='.$loginHTML.'"><img src="style/img/validate.jpg" alt="validation utilisateur" style="width:10%;height:10%"></a>';
                }
                else echo '<a href="index.php?controller=membre&action=banTempo&login='.$loginHTML.'"><img src="style/img/ban.jpg" alt="Bannissement tempo utilisateur" style="width:10%;height:10%"></a>';
                
            }
            echo '<br/> <p>'.'<b>'.$loginHTML.'</b>'.'<br/>  </p>';
            //echo intval(ModelCommentaire::getNoteMoyenne($idMembre));
            if(intval(ModelCommentaire::getNoteMoyenne($idMembre)) == 0){
                echo' <img src="style/img/star.jpg" alt="Star" style="width:10%;height:10%">';
            }else{
            for ($i = 0; $i< intval(ModelCommentaire::getNoteMoyenne($idMembre)); $i++) {
                echo' <img src="style/img/star.jpg" alt="Star" style="width:10%;height:10%">';
            }
            }
            
            echo '</div>';
            echo '</a>';
        }
        
        
    ?>
    
</div>
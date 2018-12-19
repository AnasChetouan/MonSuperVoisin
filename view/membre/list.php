
<div class="produits">
    
    <?php
       if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&Session::is_admin()==true){
            echo '<span class="ajout">
                    <a href="index.php?controller=membre&action=create">
                        <img src="style/img/add2.png" alt="image d\'ajout" height="60%" width="60%">
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
            $noteMoyenne = intval(ModelCommentaire::getNoteMoyenne($idMembre));
            //$nbrEtoile =  htmlspecialchars($u->getNom());
            echo '<a href="index.php?controller=membre&action=read&login='.$loginHTML.'&idMembre='.$idMembre.'">';
            echo '<div class="produit">';
            echo '<img src="style/img/profil.png" alt="image profil" height="50%" width="60%" >';
             if(isset($_SESSION['admin']) && Session::is_admin()==true){
                echo '<a href="index.php?controller=membre&action=delete&login='.$loginHTML.'"><img src="style/img/icone_deconnect.png" alt="supression utilisateur" style="width:10%;height:10%"></a>';
                if($u->getNonce()==1){
                echo '<a href="index.php?controller=membre&action=validate&login='.$loginHTML.'"><img src="style/img/validate.jpg" alt="validation utilisateur" style="width:10%;height:10%"></a>';
                }
                else echo '<a href="index.php?controller=membre&action=banTempo&login='.$loginHTML.'"><img src="style/img/ban.jpg" alt="Bannissement tempo utilisateur" style="width:10%;height:10%"></a>';
                
            }
            echo '<br/> <p>'.'<b>'.$loginHTML.'</b>'.'<br/>  </p>';
            for ($i = 0; $i< 5 ; $i++) {
                if($i < $noteMoyenne){
                    echo' <img src="style/img/star.png" alt="Star" style="width:10%;height:10%">';
                }
                else echo' <img src="style/img/star2.png" alt="Star" style="width:10%;height:10%">';
            }
            
            echo '</div>';
            echo '</a>';
        }
        
        
    ?>
    
</div>
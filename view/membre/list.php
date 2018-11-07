

<div class="produits">
    
    <?php
       /* if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&Session::is_admin()==true){
            echo '<span class="ajout">
                    <a href="index.php?controller=membre&action=create">
                        <img src="style/img/add2.png" alt="image d\'ajout">
                        <p>
                            Ajouter un membre
                        </p>
                    </a>
                </span>';
            
        } */
        foreach($tab_u as $u){ 
            $loginHTML = htmlspecialchars($u->getLogin());
            $idLoginURL = rawurlencode($u->getLogin());
            $nomHTML = htmlspecialchars($u->getNom());
            echo '<a href="index.php?controller=membre&action=read&login='.$loginHTML.'">';
            echo '<div class="produit">';
            echo '<img src="style/img/profil.png" alt="image profil" >';
            echo '<br/> <p>'.'<b>'.$nomHTML.'</b>'.'<br/>  </p>';
            if($u->getAdmin()==true){
                echo 'Admin';
            }else{
                echo 'Non admin';
            }
            echo '</div>';
            echo '</a>';
        } 
    ?>
</div>




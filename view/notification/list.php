<div class="produits">
    
    <?php
        if(!empty($_SESSION['login'])){
           
            foreach($tab_n as $n){
                $idNotif = htmlspecialchars($n->getIdNotif());
                $idMembre = htmlspecialchars($n->getIdMembre());
                $message = htmlspecialchars($n->getMessage()); 
                $idAdmin = htmlspecialchars($n->getIdAdmin()); 
                $reponse = htmlspecialchars($n->getReponse());
                $estRegle = htmlspecialchars($n->getEstRegle());
            
                if($estRegle == 0 && Session::is_admin()){
                 echo '<div class="notification">';
                 echo 'Message de  : '.ModelMembre::getLoginById($idMembre);
                 echo '</br>';
                 echo $message;
                 echo '</br><a href="index.php?controller=notification&action=reponse&idNotif='.$idNotif.
                         '"> </br><button>Répondre</button> </a> </br>';
                 echo '</div>';
                }
            
                
                if(($estRegle == 1) && (!Session::is_admin()) && ($idMembre == ModelMembre::getIdByLogin($_SESSION['login']))){
                 echo '<div class="notification">';
                 echo 'Message de  : '.ModelMembre::getLoginById($idAdmin);
                 echo '</br>';
                 echo $reponse;
                 echo '</br><a href="index.php?controller=notification&action=delete&idNotif='.$idNotif.
                         '"> </br><button>Supprimer</button> </a> </br>';
                 echo '</div>';
                }
                
            }
        }
    ?>
</div>

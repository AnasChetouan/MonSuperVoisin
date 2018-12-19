<?php
     
        echo '<div id="bloc_all_emprunts">';
        if(empty($tab_d)){
            echo "Vous n'avez encore rien proposé";
        }
        else{
            echo '<div id="bloc_all_propose">';
            echo '</br>';
            foreach ($tab_d as $d) {
                echo '<div id="itemEmprunt1">';
                
                
                
                $idProduit = htmlspecialchars($d->getIdProduit());
                $loginAcceptant = ModelMembre::getLoginById(htmlspecialchars($d->getIdAcceptant()));
                
                $dDebut =  htmlspecialchars($d->getDateDebut());
                $dateDT = new DateTime($dDebut);
                $dDebut = $dateDT->format('d-m-Y');
                
                $dFin =  htmlspecialchars($d->getDateFin());
                $dateDT = new DateTime($dFin);
                $dFin = $dateDT->format('d-m-Y');
                if($d->getEstBien() == 1){
                    $produit = ModelBien::select($idProduit);
                    $titre = $produit->getTitre();
                     echo $loginAcceptant." vous emprunte votre " .$titre;
                     echo " du ".$dDebut." au ".$dFin;
                    echo '</br>'.'<a href="index.php?controller=bien&action=read&idBien='.$idProduit.'"> Detail objet </a>';
                    echo '</div>';
                    echo '</br>';
                }
                else{
                    $produit = ModelService::select($idProduit);
                    $motClef = $produit->getMotClef();
                     echo $loginAcceptant." utilise votre service de " .$motClef;
                     echo " du ".$dDebut." au ".$dFin;
                     echo '</br>'.'<a href="index.php?controller=service&action=read&idService='.$idProduit.'"> Detail Service </a>';
                     echo '</div>';
                     echo '</br>';
                }
                
                
                
               
                
            }
            echo '</div>';
        }
        
        if(empty($tab_e)){
            echo "Vous n'avez encore rien emprunté";
        }
        else{
            echo '<div id="bloc_all_pris">';
            echo '</br>';
            foreach ($tab_e as $e) {
                echo '<div id="itemEmprunt2">';
                
                
                
                $idProduit = htmlspecialchars($e->getIdProduit());
                $loginAcceptant = ModelMembre::getLoginById(htmlspecialchars($e->getIdProposant()));
                
                $dDebut =  htmlspecialchars($e->getDateDebut());
                $dateDT = new DateTime($dDebut);
                $dDebut = $dateDT->format('d-m-Y');
                
                $dFin =  htmlspecialchars($e->getDateFin());
                $dateDT = new DateTime($dFin);
                $dFin = $dateDT->format('d-m-Y');
                
                if($e->getEstBien() == 1){
                    $produit = ModelBien::select($idProduit);
                    $titre = $produit->getTitre();
                    echo "Vous empruntez a ".$loginAcceptant. " son objet : ".$titre;
                    echo " du ".$dDebut." au ".$dFin;
                    echo '</br>'.'<a href="index.php?controller=bien&action=read&idBien='.$idProduit.'"> Detail objet </a>';
                    echo '</div>';
                    echo '</br>';
                }
                else{
                    $produit = ModelService::select($idProduit);
                    $motClef = $produit->getMotClef();
                    echo "Vous utilisez le service de ".$motClef." proposé par ".$loginAcceptant;
                    echo " du ".$dDebut." au ".$dFin;
                    echo '</br>'.'<a href="index.php?controller=service&action=read&idService='.$idProduit.'"> Detail Service </a>';
                    echo '</div>';
                    echo '</br>';
                }
            }
            echo '</div>';
        }
        echo '</div>';
        echo'<a href="index.php?controller=membre&action=read&login='.$login.'"> Retour </a>';
?>
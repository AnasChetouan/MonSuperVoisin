<?php


  require_once File::build_path(array("model","ModelACommande.php"));
  require_once File::build_path(array("model","ModelCommande.php"));

  $loginHTML = htmlspecialchars($u->getLogin());
  $nomHTML = htmlspecialchars($u->getNom());
  $prenomHTML = htmlspecialchars($u->getPrenom());
  $loginURL = rawurlencode($u->getLogin());
  $emailHTML = htmlspecialchars($u->getEmail());
  $adminHTML = htmlspecialchars($u->getAdmin());
  if(Session::is_user(Dispatcher::myGet('login'))){
    $suppr = "Supprimer mon compte";
    $modif = "Modifier mon compte";
  }else if(Session::is_admin()){
   $suppr = "Supprimer le membre";
   $modif = "Modifier le membre";
  }
  
  if($u->getAdmin()){
    $reponse = 'Oui';
  }
  else{ 
    $reponse= 'Non';
  }

  if(Session::is_user(Dispatcher::myGet('login'))||Session::is_admin()){
    echo '
        <p>Membre de login <b>'. $loginHTML .'</b> :<br>
           Prénom : '.$prenomHTML. '<br>
           Nom : '.$nomHTML . '<br>
           Email :' . $emailHTML .'<br>
           Administrateur :' . $reponse .'<br> 
            <a href="index.php?controller=membre&action=delete&login='.$loginURL.'" title="Supprimer">'.$suppr.'</a><br>
            <a href="index.php?controller=membre&action=update&login='.$loginURL.'" title="Modifier">'.$modif.'</a>
        </p>';
  }
  echo "<h4>Vos commandes</h4> <br/>";
  $tab_commande= ModelCommande::selectAllCommandeByLogin($login);
  if($tab_commande==false){
    echo"Vous n'avez pas de commande !";
  }
  else{
    //var_dump($tab_commande);
    foreach($tab_commande as $l){ 
      
      $idCom=$l->getIdCommande();
      echo "<h3>Commande d'id ".$idCom."  : </h3><br/>";
      
      $tab_po= ModelACommande::selectAllCommandeByidCommande($idCom);
      if($tab_po==false){
        echo"Vous n'avez pas de commande !";
      }
      else{
        foreach($tab_po as $p){
          
          $idProduithtml = htmlspecialchars($p->getIdProduit());
          $idSousCategoriehtml = htmlspecialchars($p->getIdSousCategorie());
          switch($idSousCategoriehtml){
            case "Velo":
              $idObjet = 'idVelo';
              break;
            case "Accessoire":
              $idObjet = 'idAccessoire';
              break;
            case "PieceDetache":
              $idObjet = 'idPieceDetache';
              break;
          }
          $produit= ModelACommande::selectAllProduitByidCommande($p->getIdProduit(), $p->getIdSousCategorie());
          if($produit==false){
            echo"Vous n'avez pas de commande !";
          }
          else{
            switch($idSousCategoriehtml){
              case "Velo":
                $p = ModelVelo::select($idProduithtml);
                echo '<div class="bloc_commande">';
                echo '<img src="'.$p->getAdresseImage().'" alt="image_produit"></br>';
                echo "Id produit : ".$idProduithtml.'</br>';
                echo  '<b>'.$p->getNomVelo().'</b></br>';
                echo  '<p class="prix">'.$p->getPrix().'€</p>';
                echo 'Taille : '.$p->getTailleVelo().'</br>';
                echo 'Categorie : '.$p->getIdCategorie().'</br>';
                echo '</div>';
                break;
              case "Accessoire":
               $p=ModelAccessoire::select($idProduithtml);
                break;
              case "PieceDetache":
               $p=ModelPieceDetache::select($idProduithtml);
                break;
            }
            
      }
    }
  }
    }
  }

  
?>
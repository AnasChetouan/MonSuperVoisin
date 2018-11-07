<?php


  $loginHTML = htmlspecialchars($u->getLogin());
  $nomHTML = htmlspecialchars($u->getNom());
  $prenomHTML = htmlspecialchars($u->getPrenom());
  $loginURL = rawurlencode($u->getLogin());
  $emailHTML = htmlspecialchars($u->getmail());
  $adminHTML = htmlspecialchars($u->getAdmin());
  
  if($u->getAdmin()){
    $reponse = 'Oui';
  }
  else{ 
    $reponse= 'Non';
  }
 echo '
        <p>Utilisateur de login <b>'. $loginHTML .'</b><br>
           Prénom : '.$prenomHTML. '<br>
           Nom : '.$nomHTML . '<br>
           Email : ' . $emailHTML .'<br>
           Administrateur : ' . $reponse .'<br> 
           <a href="index.php?controller=membre&action=readAll"> Retour </a>
        </p>';
 /*<a href="index.php?controller=membre&action=delete&login='.$loginURL.'" title="Supprimer">'.'</a><br>
            <a href="index.php?controller=membre&action=update&login='.$loginURL.'" title="Modifier">'.'</a> */
?>

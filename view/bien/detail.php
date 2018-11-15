<?php

  $descriptionHTML = htmlspecialchars($b->getDescription());
  $titreHTML = htmlspecialchars($b->getTitre());
  $lienPhoto = ($b->getLienPhoto());
  $tarif = ($b->getTarif());
  $prixNeuf = ($b->getPrixNeuf());
    echo '
           <p><b> Titre : </b> '.$titreHTML . '<br> <br>'
             .'<img src='.$lienPhoto.' alt="photo bien" height="352" width="470" > <br> <br>'.
              'Description : ' . $descriptionHTML .'<br> <br>
              Montant prix d\'achat neuf : <b> ' . $prixNeuf . '</b> € <br>
              Prix d\'emprunt à la journée : <b>'.$tarif . ' </b> € <br> <br>
              <a href="index.php?controller=bien&action=readAll"> Retour </a>
           </p>';

   ?>

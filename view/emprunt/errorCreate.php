  <div id="erreur">
    <p>
      <p>Erreur</p>
      <div><img id="image_erreur_utilisateur" src="./style/img/icone_error.png" alt="image_erreur"></div>
      <?php echo $message; ?>
    </p>
    <?php 
    switch($redirection)
    {
     case "service":
        $action = "readAll";
        $controller = "service";
        break;

      case "bien":
        $action = "readAll";
        $controller = "bien";
        break;
    }
   
    ?>
    <a href="index.php?controller=<?php echo $controller; ?>&action=<?php echo $action; ?>"> Retour vers la page précédente </a>
  </div>
  

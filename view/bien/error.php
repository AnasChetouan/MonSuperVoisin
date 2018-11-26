
  <div id="erreur">
    <p>
      <p>Erreur</p>
      <div><img id="image_erreur_utilisateur" src="./style/img/icone_error.png" alt="image_erreur"></div>
      <?php echo $message; ?>
    </p>
    <?php 
    switch($pb)
    {
      case "extension":
        $action = "create";
        $controller = "bien";
        break;

      case "taille":
        $action = "create";
        $controller = "bien";
        break;

      case "erreur_envoi":
        $action = "create";
        $controller = "bien";
        break;

      case "catégorie":
        $action = "create";
        $controller = "bien";
        break;
    
       case "prix":
        $action = "create";
        $controller = "bien";
        break;
    
      case "errorRead":
          $action = "readAll";
          $controller = "bien";

      case "update":
          $action = "readAll";
          $controller = "bien";
    }
   
    ?>
    <a href="index.php?controller=<?php echo $controller; ?>&action=<?php echo $action; ?>"> Retour vers la page précédente </a>
  </div>
  

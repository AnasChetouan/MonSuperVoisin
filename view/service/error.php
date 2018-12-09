  <div id="erreur">
    <p>
      <p>Erreur</p>
      <div><img id="image_erreur_utilisateur" src="./style/img/icone_error.png" alt="image_erreur"></div>
      <?php echo $message; ?>
    </p>
    <?php 
    switch($pb)
    {
      case "prix":
        $action = "create";
        $controller = "service";
        break;

      case "categorie":
        $action = "create";
        $controller = "service";
        break;

      case "dispo":
        $action = "create";
        $controller = "service";
        break;

      case "errorRead":
        $action = "readAll";
        $controller = "service";
        break;

      case "update":
        $action = "readAll";
        $controller = "service";
        break;

      case "autorisation":
        $action = "readAll";
        $controller = "service";
        break;

      case "update":
        $action = "update";
        $controller = "service";
        break;
    }
    ?>
    <a href="index.php?controller=<?php echo $controller; ?>&action=<?php echo $action; ?>"> Retour vers la page précédente </a>
  </div>
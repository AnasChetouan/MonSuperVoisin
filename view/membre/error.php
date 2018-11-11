
  <div id="erreur">
    <p>
      <p>Erreur</p>
      <div><img id="image_erreur_utilisateur" src="./style/img/icone_error.png" alt="image_erreur"></div>
      <?php echo $message; ?>
    </p>
    <?php 
    switch($pb)
    {
      case "mdp":
        $action = "create";
        $control = "membre";
        break;
      case "update":
        $action = "update";
         $control = "membre";
        break;
      case "connexion":
        $action = "connect"; 
        $control = "membre";
        break;
    }
   
    ?>
    <a href="index.php?controller=<?php echo $control; ?>&action=<?php echo $action; ?>"> Retour vers la page précédente </a>
  </div>
  

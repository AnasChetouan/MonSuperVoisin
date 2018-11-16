<?php

$idVeloHTML = htmlspecialchars($v->getIdVelo());
$nomVeloHTML = htmlspecialchars($v->getNomVelo());
$prixHTML = htmlspecialchars($v->getPrix());
$tailleVeloHTML = htmlspecialchars($v->getTailleVelo());
$quantiteStockHTML = htmlspecialchars($v->getQuantiteStock());
$idCategorieHTML = htmlspecialchars($v->getIdCategorie());
$AdresseImageHTML = htmlspecialchars($v->getAdresseImage());


switch ($functionCaller) {
    case "create":
        $formTitle="Créer";
        $hiddenValue="created";
        $affId = "hidden";
        $visible = "position:absolute;visibility:hidden;";
        break;
    case "update":
        $formTitle="Modifier";
        $hiddenValue="updated";
        $affId = "number";
        $visible = "";
        break;
}

?>
<form method="get" action="index.php">
    <fieldset>
        <legend><?=$formTitle?> un velo:</legend>
        <input type="hidden" name="controller" value="<?=static::$controller?>">
        <input type="hidden" name="action" value="<?=$hiddenValue?>">
        <p style="<?=$visible?>">
            <label for="id_id">Id du vélo :</label>
            <input type="<?=$affId?>" name="id" id="id_id" value="<?=$idVeloHTML?>" readonly />
        </p>
        <p>
            <label for="nom_id">Nom du vélo :</label> <span>*</span>
            <input type="text" name="nom" id="nom_id" value="<?=$nomVeloHTML?>" placeholder="Exemple : Commencal Meta Am" required/>
        </p>
        <p>
            <label for="prix_id">Prix :</label> <span>*</span>
            <input type="number" name="prix" id="prix_id" value="<?=$prixHTML?>" placeholder="Exemple : 1200" required/>
        </p>
        <p>
            <label for="taille_id">Taille  :</label> <span>*</span>
            <input type="text" name="taille" id="taille_id" value="<?=$tailleVeloHTML?>" placeholder="Exemple : S/M/L" required />
        </p>
        <p>
            <label for="quantite_id">Quantité Stock :</label> <span>*</span>
            <input type="number" name="quantite" id="quantite_id" value="<?=$quantiteStockHTML?>" placeholder="Exemple : 10" required/>
        </p>
        <p>
            <label for="categorie_id">Catégorie :</label>  <span>*</span></label>
                      <select class ="champs" id="categorie_id" name="categorie" required>
                        <?php
                          foreach($tab_c as $c){
                            $categ = $c->getIdCategorie();
                            if($categ==$idCategorieHTML){
                                echo '<option selected value="'.$categ.'">'.$categ.'</option>';
                              }else{
                                  echo '<option value="'.$categ.'">'.$categ.'</option>';
                              }
                          }
                          ?>
                      </select>
        </p>
        <p>
            <label for="adresseImg_id">Adresse Image :</label> <span>*</span>
            <input type="url" name="adresseImage" id="adresseImage_id" value="<?=$AdresseImageHTML?>" placeholder="Exemple : Rouge" required/>
        </p>
        
        
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
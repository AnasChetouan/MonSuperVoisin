<?php
$idProduit = ($b->getIdBien());
$idProprio = ($b->getIdProrio());


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
        <legend><?=$formTitle?> Commentaire :</legend>
        <input type="hidden" name="controller" value="<?=static::$controller?>">
        <input type="hidden" name="action" value="<?=$hiddenValue?>">
        <input type="hidden" name="idP" value="<?=$idProduit?>">
        <input type="hidden" name="idmembre" value="<?=$idProprio?>">
        <p>
        <label for="appreciation">Laissez un commentaire :</label><br/>
        <textarea name="appreciation" id="ameliorer"></textarea>
        </p>
        <p>
        <label for="etoile">Nombre d'Etoiles</label><br/>
        <input type="number" name="etoile" min="0" max="5" step="1"/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
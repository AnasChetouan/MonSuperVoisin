<?php

$loginHTML = htmlspecialchars($u->getLogin());
$nomHTML = htmlspecialchars($u->getNom());
$prenomHTML = htmlspecialchars($u->getPrenom());
$telephoneHTML = htmlspecialchars($u->getTelephone());
$adresseHTML = htmlspecialchars($u->getAdresse());
$codePostalHTML = htmlspecialchars($u->getCodePostal());
$villeHTML = htmlspecialchars($u->getVille());
$mdpHTML = htmlspecialchars($u->getMdp());
$mailHTML = htmlspecialchars($u->getMail());
$adminHTML = htmlspecialchars($u->getAdmin());

switch($adminHTML){
    case true:
        $affichage = '<input type="radio" name="admin" value="oui" checked> Oui<br>
             <input type="radio" name="admin" value="non"> Non<br>';
             break;
    case false:
        $affichage = '<input type="radio" name="admin" value="oui"> Oui<br>
             <input type="radio" name="admin" value="non" checked> Non<br>';
             break;
}

switch ($functionCaller) {
    case "create":
        $formTitle="Créer";
        $hiddenValue="created";
        $attribut = " ";
        break;
    case "update":
        $formTitle="Modifier";
        $hiddenValue="updated";
        $attribut="readonly";
        break;
}
if($functionCaller!="update"||$admin!="oui"){ //si l'action n'est pas de modifier ou que la personne connecté n'est pas un admin (seul les connectés ont accés à la modification des parametres du profil personnel)
    $styles = "position: absolute;" //cette variable est appelé par la suite pour ne pas afficher le champ avec le checkbox (case à cocher pour savoir si l'utlisateur est admin)
    . "visibility: hidden;";
}
if(isset($admin)){
    if($admin=="oui"){
        $formTitle= $formTitle." un client";
    }else if($functionCaller=="update"){
        $formTitle="Modifier son compte";
    }
}else{
    $formTitle="S'inscrire";
}



if(Conf::getDebug()==false){
    $method = "post";
}else{
    $method = "get";
}


?>
<div id="bloc_form_create_update">
    <form method="<?=$method?>" action="index.php">
    <fieldset>
        <legend><?=$formTitle?></legend>
        
        <input type="hidden" name="controller" value="Membre">
        <input type="hidden" name="action" value="<?=$hiddenValue?>">
        <p>
            <label for="login_id">Login :</label> <span>*</span>
            <input type="text" name="login" id="login_id" value="<?=$loginHTML?>" placeholder="Exemple : jSmith" required <?php echo $attribut ;?>/>
        </p>
        <?php
        if($functionCaller=="create"){
             echo ' 
            
        <p>
            <label for="mdp_id">Mot de passe :</label> <span>*</span>
            <input type="password" name="mdp" id="mdp_id" value="'.$mdpHTML.'" required />
        </p>
        <p>
            <label for="mdp2_id">Validation du mot de passe (retaper le):</label> <span>*</span>
            <input type="password" name="mdp2" id="mdp2_id" value="'.$mdpHTML.'" required />
        </p>
        
            ';
        }
            else if($functionCaller=="update"&&Session::is_user($loginHTML)){
               echo ' 
            
        <p>
            <label for="mdp_id">Mot de passe :</label> <span>*</span>
            <input type="password" name="mdp" id="mdp_id" value="'.$mdpHTML.'" required />
        </p>
        <p>
            <label for="mdp2_id">Validation du mot de passe (retapez le):</label> <span>*</span>
            <input type="password" name="mdp2" id="mdp2_id" value="'.$mdpHTML.'" required />
        </p>
        
            ';}
        ?>
        <p>
            <label for="name_id">Nom :</label> <span>*</span>
            <input type="text" name="nom" id="name_id" pattern="[a-zA-Z\ ]*" value="<?=$nomHTML?>" placeholder="Votre nom" required/>
        </p>
        <p>
            <label for="prenom_id">Prénom :</label> <span>*</span>
            <input type="text" name="prenom" id="prenom_id" pattern="[a-zA-Z\ ]*" value="<?=$prenomHTML?>" placeholder="Votre prénom" required/>
        </p>
        
        <?php if($functionCaller=="update"){ $typeInput="mail";}else{$typeInput="text";} ?>
        <p>
            <label for="mail_id">Mail :</label> <span>*</span>
            <input type="<?=$typeInput?>" name="mail" id="mail_id" value="<?=$mailHTML?>"  required <?php if($functionCaller=="update"){echo "readonly";}?>/>
        </p>
        <p>
            <label for="telephone_id">Telephone :</label> <span>*</span>
            <input type="text" name="telephone" id="prenom_id" pattern="[0-9]{10}" value="<?=$telephoneHTML?>" placeholder="0690456738" required/>
        </p>
        <p>
            <label for="adresse_id">Adresse :</label> <span>*</span>
            <input type="text" name="adresse" id="prenom_id" value="<?=$adresseHTML?>" placeholder="26 rue des rossignols" required/>
        </p>
        <p>
            <label for="ville_id">Ville :</label> <span>*</span>
            <input type="text" name="ville" id="prenom_id" value="<?=$villeHTML?>" placeholder="Sete" required/>
        </p>
        <p>
            <label for="codePostal_id">Code Postal :</label> <span>*</span>
            <input type="text" name="codePostal" id="prenom_id" value="<?=$codePostalHTML?>" placeholder="34200" required/>
        </p>
        <div style="<?=$styles?>">
            <p> Administrateur ? </p>
            <?php echo $affichage; ?>
        </div>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</div>
    
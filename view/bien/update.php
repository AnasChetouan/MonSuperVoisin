<?php
$idBien = htmlspecialchars($b->getIdBien());
$titre = htmlspecialchars($b->getTitre());
$motClef = htmlspecialchars($b->getMotClef());
$description = htmlspecialchars($b->getDescription());
$prixneuf = htmlspecialchars($b->getPrixNeuf());
switch ($functionCaller) {
    case "create":
        $formTitle="Proposer un bien";
        $hiddenValue="created";
        $attribut = " ";
        break;
    case "update":
        $formTitle="Modifier un bien";
        $hiddenValue="updated";
        $attribut="readonly";
        break;
}
/*if(Conf::getDebug()==false){
    $method = "post";
}else{
    $method = "get";
    
    On ne peut pas le faire ici car la method get ne fonctionne pas pour envoyer un fichier
}*/
?>



<div>
<form action="index.php" method="post" enctype="multipart/form-data" id="pageUpdateBien">
     <fieldset id="formulaire">
         <legend><?=$formTitle?></legend>
    <input type='hidden' name='controller' value='Bien'>
    <input type='hidden' name='action' value='<?=$hiddenValue?>'>
    <input type='hidden' name='idBien' value='<?=$idBien?>'>
                      <div> 
                            <!-- Catégories inspirées du site "leboncoin" -->
                            <label for="motClef"> Catégorie du bien : </label> 
                            <select name="motClef" id="motClef">
                                <?php if($functionCaller == "update"){ echo "<optgroup label ='Votre ancienne catégorie'>"; }?>
                                <option  value="<?=$motClef?>"><?php if($functionCaller == "update")echo $motClef; else echo "Choisir une catégorie";?></option>
                                <?php if($functionCaller == "update"){ echo "</optgroup>"; }?>
                                <optgroup label ="Multimedia">
                                    <option value="Informatique">Informatique</option>
                                    <option value="Console & Jeux vidéos">Console & Jeux vidéos</option>
                                    <option value="Image & Son">Image & Son</option>
                                    <option value="Téléphonie">Téléphonie</option>
                                </optgroup>
                                <optgroup label ="Maison">
                                    <option value="Ameublement">Ameublement</option>
                                    <option value="Electroménager">Electroménager</option>
                                    <option value="Arts de la table">Arts de la table</option>
                                    <option value="Décoration">Décoration</option>
                                    <option value="Linge de maison">Linge de maison</option>
                                    <option value="Bricolage">Bricolage</option>
                                    <option value="Jardinage">Jardinage</option>
                                    <option value="Vêtements">Vêtements</option>
                                    <option value="Chaussures">Chaussures</option>
                                    <option value="Accessoires & Bagagerie">Accessoires & Bagagerie</option>
                                    <option value="Montres & Bijoux">Montres & Bijoux</option>
                                    <option value="Equipement bébé">Equipement bébé</option>
                                    <option value="Vêtements bébé">Vêtements bébé</option>
                                </optgroup>
                                <optgroup label ="Loisirs">
                                    <option value="DVD / Films">DVD / Films</option>
                                    <option value="CD / Musique">CD / Musique</option>
                                    <option value="Livres">Livres</option>
                                    <option value="Animaux">Animaux</option>
                                    <option value="Vélos">Vélos</option>
                                    <option value="Sports & Hobbies">Sports & Hobbies</option>
                                    <option value="Instruments de musique">Instruments de musique</option>
                                    <option value="Collection">Collection</option>
                                    <option value="Jeux & Jouets">Jeux & Jouets</option>
                                </optgroup>
                                <optgroup label ="Matériel professionnel">
                                    <option value="Matériel agricole">Matériel agricole</option>
                                    <option value="Transport - Manutention">Transport - Manutention</option>
                                    <option value="BTP-Chantier Gros-oeuvre">BTP-Chantier Gros-oeuvre</option>
                                    <option value="Outillage - Matériaux 2nd-oeuvre">Outillage - Matériaux 2nd-oeuvre </option>
                                    <option value="Equipements Industriels">Equipements Industriels</option>
                                    <option value="Restauration - Hôtellerie">Restauration - Hôtellerie</option>
                                    <option value="Fournitures de Bureau">Fournitures de Bureau</option>
                                    <option value="Commerces & Marchés">Commerces & Marchés</option>
                                    <option value="Matériel Médical">Matériel Médical</option>
                                </optgroup>
                                <optgroup label ="Autres">
                                    <option value="autres">Autres</option>
                                </optgroup>
                            </select>
                        </div>
                        <div>
                            Titre de l'annonce :
                            <input type="text" name="titre" value="<?=$titre?>" required />
                        </div> 

                        <div>
                            <label for="description">Description :</label><textarea name="description" rows="8" cols="45" required><?php echo $description?></textarea>
                        </div> 
                        
                        <div>
                            Prix neuf :
                            <input type="text" name="prixNeuf" value="<?=$prixneuf?>" required /> €
                        </div> 

                <?php if($functionCaller == "create"){
                    echo '
                        <div>
                            Photo du bien :<br />
                            <input type="file" name="photo" required /><br />
                        </div>'; 
                        }
                        ?>
                    <input type="submit" value="Valider" />
                
                    
    </fieldset>
</form></div> 
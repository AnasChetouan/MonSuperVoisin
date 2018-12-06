<?php

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


$titreHTML = htmlspecialchars($b->getTitre());
$descriptionHTML = htmlspecialchars($b->getDescription());
$prixNeufHTML = htmlspecialchars($b->getPrixNeuf());
$motClef = ($b->getMotClef());
$lienPhoto = ($b->getLienPhoto());
$admin = "oui";

?>


<form action="index.php" method="post" enctype="multipart/form-data">
     <fieldset>
         <legend><?=$formTitle?></legend>
    <input type='hidden' name='controller' value='Bien'>
    <input type='hidden' name='action' value='<?=$hiddenValue?>'>
    <?php // Quand on modifie un bien, on a besoin de l'id du bien modifié
    if ($functionCaller == "update"){ // On en a besoin seulement quand on veut modifier un bien et pas quand on crée un
        $idBien = ($b->getIdBien());
        echo '<input type="hidden" name="id" value='.$idBien;
        }?>

                        <div> 
                            <!-- Catégories inspirées du site "leboncoin" 
                            Le code peut être modifié plus efficacement si on génère le code avec une boucle php 
                            à modifier plus tard si besoin -->
                            <label for="motClef"> Catégorie du bien : </label> 
                            <select name="motClef"  id="motClef">
                                <option  value="null">Choissisez la catégorie</option>
                                <optgroup label ="Multimedia" >
                                    <option value="informatique" <?php if ($motClef == "informatique") { echo "selected"; } ?> >Informatique</option>
                                    <option value="console-jv" <?php if ($motClef == "console-jv") { echo "selected"; } ?> >Console & Jeux vidéos</option>
                                    <option value="image-son" <?php if ($motClef == "image-son") { echo "selected"; } ?> >Image & Son</option>
                                    <option value="telephonie" <?php if ($motClef == "telephonie") { echo "selected"; } ?> >Téléphonie</option>
                                </optgroup>
                                <optgroup label ="Maison">
                                    <option value="ameublement" <?php if ($motClef == "ameublement") { echo "selected"; } ?> >Ameublement</option>
                                    <option value="electromenager" <?php if ($motClef == "electromenager") { echo "selected"; } ?> >Electroménager</option>
                                    <option value="arts-table" <?php if ($motClef == "arts-table") { echo "selected"; } ?> >Arts de la table</option>
                                    <option value="decoration" <?php if ($motClef == "decoration") { echo "selected"; } ?> >Décoration</option>
                                    <option value="linge-maison" <?php if ($motClef == "linge-maison") { echo "selected"; } ?> >Linge de maison</option>
                                    <option value="bricolage" <?php if ($motClef == "bricolage") { echo "selected"; } ?> >Bricolage</option>
                                    <option value="jardinage" <?php if ($motClef == "jardinage") { echo "selected"; } ?> >Jardinage</option>
                                    <option value="vetements" <?php if ($motClef == "vetements") { echo "selected"; } ?> >Vêtements</option>
                                    <option value="chaussures" <?php if ($motClef == "chaussures") { echo "selected"; } ?> >Chaussures</option>
                                    <option value="accessoires-bagagerie" <?php if ($motClef == "accessoires-bagagerie") { echo "selected"; } ?> >Accessoires & Bagagerie</option>
                                    <option value="montres-bijoux" <?php if ($motClef == "montres-bijoux") { echo "selected"; } ?> >Montres & Bijoux</option>
                                    <option value="equipement-bebe" <?php if ($motClef == "equipement-bebe") { echo "selected"; } ?> >Equipement bébé</option>
                                    <option value="vetements-bebe" <?php if ($motClef == "vetements-bebe") { echo "selected"; } ?> >Vêtements bébé</option>
                                </optgroup>
                                <optgroup label ="Loisirs">
                                    <option value="dvd-films" <?php if ($motClef == "dvd-films") { echo "selected"; } ?> >DVD / Films</option>
                                    <option value="cd-musique" <?php if ($motClef == "cd-musique") { echo "selected"; } ?> >CD / Musique</option>
                                    <option value="livres" <?php if ($motClef == "livres") { echo "selected"; } ?> >Livres</option>
                                    <option value="animaux" <?php if ($motClef == "animaux") { echo "selected"; } ?> >Animaux</option>
                                    <option value="velos" <?php if ($motClef == "velos") { echo "selected"; } ?> >Vélos</option>
                                    <option value="sports-hobbies" <?php if ($motClef == "sports-hobbies") { echo "selected"; } ?> >Sports & Hobbies</option>
                                    <option value="instruments" <?php if ($motClef == "instruments") { echo "selected"; } ?> >Instruments de musique</option>
                                    <option value="collection" <?php if ($motClef == "collection") { echo "selected"; } ?>>Collection</option>
                                    <option value="jeux-jouets" <?php if ($motClef == "jeux-jouets") { echo "selected"; } ?> >Jeux & Jouets</option>
                                </optgroup>
                                <optgroup label ="Matériel professionnel">
                                    <option value="materiel-agricole" <?php if ($motClef == "materiel-agricole") { echo "selected"; } ?> >Matériel agricole</option>
                                    <option value="transport-manutention" <?php if ($motClef == "transport-manutention") { echo "selected"; } ?> >Transport - Manutention</option>
                                    <option value="btp-groschantier" <?php if ($motClef == "btp-groschantier") { echo "selected"; } ?> >BTP-Chantier Gros-oeuvre</option>
                                    <option value="outillage-materiaux" <?php if ($motClef == "outillage-materiaux") { echo "selected"; } ?> >Outillage - Matériaux 2nd-oeuvre </option>
                                    <option value="equipement-industriel" <?php if ($motClef == "equipement-industriel") { echo "selected"; } ?> >Equipements Industriels</option>
                                    <option value="restauration-hotellerie" <?php if ($motClef == "restauration-hotellerie") { echo "selected"; } ?> >Restauration - Hôtellerie</option>
                                    <option value="fournitures-bureau" <?php if ($motClef == "fournitures-bureau") { echo "selected"; } ?> >Fournitures de Bureau</option>
                                    <option value="commerces-marches" <?php if ($motClef == "commerces-marches") { echo "selected"; } ?> >Commerces & Marchés</option>
                                    <option value="materiel-medical" <?php if ($motClef == "materiel-medical") { echo "selected"; } ?> >Matériel Médical</option>
                                </optgroup>
                                <optgroup label ="Autres">
                                    <option value="autres">Autres</option>
                                </optgroup>
                            </select>
                        </div>   

                        <div>
                            Titre de l'annonce :
                            <input type="text" name="titre" value="<?=$titreHTML?>" required />
                        </div> 

                        <div>
                            <label for="description">Description :</label><textarea name="description" rows="8" cols="45" required><?php echo $descriptionHTML ?></textarea>
                        </div> 
                        
                        <div>
                            Prix neuf :
                            <input type="text" name="prixNeuf" value="<?=$prixNeufHTML?>" required /> €
                        </div> 
   
                      <br>
                        <div>
                            <p class="photo">
                            Photo du bien :<br />
                            <?php if($functionCaller=="update"){ 
                             echo '<img src='.$lienPhoto.' alt="photo bien" height="25%" width="25%" > <br> <br>' 
                             .'<input type="button" value="Changer la photo ?" onclick="affiche()" >';
                            }
                            else
                                echo '<input type="file" name="photo" required /><br />';
                                    ?>
                            
                            </p>
                            
                            <script type="text/javascript"> // Fonction javascript pour afficher un formulaire HTML après avoir cliqué sur le bouton ci-dessus
                            function affiche() {
                                var newPara = document.createElement('p');
                                newPara.id = 'nouveau';
                                var texte = document.createTextNode('<p> test </p>');
                                // '<p> <input type="file" name="photo" required /><br /> </p>
                                newPara.appendChild(texte);
                                document.body.appendChild(newPara);
                            }
                            </script>
                            
                        </div> 
                        
                    <input type="submit" value="Valider" />
                    
    </fieldset>
</form>            
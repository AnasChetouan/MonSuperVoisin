<?php

$formTitle="Proposer un bien";

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

?>


<form action="index.php" method="post" enctype="multipart/form-data">
     <fieldset>
         <legend><?=$formTitle?></legend>
    <input type='hidden' name='controller' value='Bien'>
    <input type='hidden' name='action' value='<?=$hiddenValue?>'>

                        <div> 
                            <!-- Catégories inspirées du site "leboncoin" -->
                            <label for="motClef"> Catégorie du bien : </label> 
                            <select name="motClef" id="motClef">
                                <option  value="null">Choissisez la catégorie</option>
                                <optgroup label ="Multimedia">
                                    <option value="informatique">Informatique</option>
                                    <option value="console-jv">Console & Jeux vidéos</option>
                                    <option value="image-son">Image & Son</option>
                                    <option value="telephonie">Téléphonie</option>
                                </optgroup>
                                <optgroup label ="Maison">
                                    <option value="ameublement">Ameublement</option>
                                    <option value="electromenager">Electroménager</option>
                                    <option value="arts-table">Arts de la table</option>
                                    <option value="decoration">Décoration</option>
                                    <option value="linge-maison">Linge de maison</option>
                                    <option value="bricolage">Bricolage</option>
                                    <option value="jardinage">Jardinage</option>
                                    <option value="vetements">Vêtements</option>
                                    <option value="chaussures">Chaussures</option>
                                    <option value="accessoires-bagagerie">Accessoires & Bagagerie</option>
                                    <option value="montres-bijoux">Montres & Bijoux</option>
                                    <option value="equipement-bebe">Equipement bébé</option>
                                    <option value="vetements-bebe">Vêtements bébé</option>
                                </optgroup>
                                <optgroup label ="Loisirs">
                                    <option value="dvd-films">DVD / Films</option>
                                    <option value="cd-musique">CD / Musique</option>
                                    <option value="livres">Livres</option>
                                    <option value="animaux">Animaux</option>
                                    <option value="velos">Vélos</option>
                                    <option value="sports-hobbies">Sports & Hobbies</option>
                                    <option value="instruments">Instruments de musique</option>
                                    <option value="collection">Collection</option>
                                    <option value="jeux-jouets">Jeux & Jouets</option>
                                </optgroup>
                                <optgroup label ="Matériel professionnel">
                                    <option value="materiel-agricole">Matériel agricole</option>
                                    <option value="transport-manutention">Transport - Manutention</option>
                                    <option value="btp-groschantier">BTP-Chantier Gros-oeuvre</option>
                                    <option value="outillage-materiaux">Outillage - Matériaux 2nd-oeuvre </option>
                                    <option value="equipement-industriel">Equipements Industriels</option>
                                    <option value="restauration-hotellerie">Restauration - Hôtellerie</option>
                                    <option value="fournitures-bureau">Fournitures de Bureau</option>
                                    <option value="commerces-marches">Commerces & Marchés</option>
                                    <option value="materiel-medical">Matériel Médical</option>
                                </optgroup>
                                <optgroup label ="Autres">
                                    <option value="autres">Autres</option>
                                </optgroup>
                            </select>
                        </div>   

                        <div>
                            Titre de l'annonce :
                            <input type="text" name="titre" required />
                        </div> 

                        <div>
                            <label for="description">Description :</label><textarea name="description" rows="8" cols="45" required></textarea>
                        </div> 
                        
                        <div>
                            Prix neuf :
                            <input type="text" name="prixNeuf" required /> €
                        </div> 

  
                        <div>
                            Photo du bien :<br />
                            <input type="file" name="photo" required /><br />
                        </div> 
                        
                    <input type="submit" value="Valider" />
                    
    </fieldset>
</form>            
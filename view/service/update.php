<?php

$idService = htmlspecialchars($s->getidService());
$motClef = htmlspecialchars($s->getMotClef());
$description = htmlspecialchars($s->getDescription());
$tarif = htmlspecialchars($s->getTarif());

switch ($functionCaller) {
    case "create":
        $formTitle="Proposer un service";
        $hiddenValue="created";
        //$attribut = " ";
        break;
    case "update":
        $formTitle="Modifier un service";
        $hiddenValue="updated";
        //$attribut="readonly";
        break;
}

if(Conf::getDebug()==false){
    $method = "post";
}else{
    $method = "get";
}

?>


<form action="index.php" method="<?=$method?>" enctype="multipart/form-data" id="pageUpdateBien">

     <fieldset  id="formulaire">
         <legend><?=$formTitle?></legend>
    <input type='hidden' name='controller' value='Service'>
    <input type='hidden' name='action' value='<?=$hiddenValue?>'>
    <input type='hidden' name='idService' value='<?=$idService?>'>

                      <div> 
                            <label for="motClef"> Type du service : </label> 
                            <select name="motClef" id="motClef">
                            	<?php if($functionCaller == "update"){ echo "<optgroup label ='Votre ancienne catégorie'>"; }?>
                                <option  value="<?=$motClef?>"><?php if($functionCaller == "update")echo $motClef; else echo "Choisir une catégorie";?></option>
                                <?php if($functionCaller == "update"){ echo "</optgroup>"; }?>
                                <optgroup label ="Surveillance">
                                    <option value="Babysitting">Babysitting</option>
                                    <option value="Garde d'animaux">Garde d'animaux</option>
                                </optgroup>
                                <optgroup label ="Réparation / Bricolage">
                                    <option value="Réparation d'appareils électroniques">Réparation d'appareils électroniques</option>
                                    <option value="Plomberie">Plomberie</option>
                                    <option value="Montage">Montage</option>
                                </optgroup>
                                <optgroup label ="Soins">
                                    <option value="Coiffure">Coiffure</option>
                                </optgroup>
                                 <optgroup label ="Enseignement">
                                    <option value="Soutien scolaire">Soutien scolaire</option>
                                    <option value="Cours de langue">Cours de langue</option>
                                </optgroup>
                                <optgroup label ="Aides diverses">
                                    <option value="Aide au déménagement">Aide au déménagement</option>
                                    <option value="Ménage">Ménage</option>
                                </optgroup>
                                <optgroup label ="Autres">
                                    <option value="Autres">Autres</option>
                                </optgroup>
                            </select>
                            <br>
                            Des suggestions à faire pour les catégories ? <a href="index.php?controller=notification&action=create">Dites-le nous!</a>
                            <br>
                        </div>

                        <div>
                            <label for="description">Description :</label><textarea name="description" rows="8" cols="45" required><?php echo $description?></textarea>
                        </div> 
                        
                        <div>
                            Tarif horaire :
                            <input type="text" name="tarif" value="<?=$tarif?>" required /> €
                        </div> 

                        <br>

                        Vos disponibilités pour ce service :
                        <br> <br>

                        <div id="jours">

						<!-- Lundi <input type="checkbox" name="lundi" value="lundi" onclick="test()"><br> 
						Mardi <input type="checkbox" name="mardi" value="mardi" onclick="test()"><br> 
						Mercredi <input type="checkbox" name="mercredi" value="mercredi" onclick="test()"><br> 
						Jeudi <input type="checkbox" name="jeudi" value="jeudi" onclick="test()"><br> 
						Vendredi <input type="checkbox" name="vendredi" value="vendredi" onclick="test()"><br> 
						Samedi <input type="checkbox" name="samedi" value="samedi" onclick="test()"><br> 
						Dimanche <input type="checkbox" name="dimanche" value="dimanche" onclick="test()"><br>  -->

						</div>

						<br>

						<div id="disponibilites">

							<div id="LUN"> </div>
							<div id="MAR"> </div>
							<div id="MER"> </div>
							<div id="JEU"> </div>
							<div id="VEN"> </div>
							<div id="SAM"> </div>
							<div id="DIM"> </div>

						</div> 

						<script>

							var jours = [
							    {
							        code: "LUN",
							        nom: "Lundi "
							    },
							    {
							        code: "MAR",
							        nom: "Mardi "
							    },
							    {
							        code: "MER",
							        nom: "Mercredi "
							    },
							    {
							        code: "JEU",
							        nom: "Jeudi "
							    },
							   	{
							        code: "VEN",
							        nom: "Vendredi "
							    },
							    {
							        code: "SAM",
							        nom: "Samedi "
							    },
							    {
							        code: "DIM",
							        nom: "Dimanche "
							    }
							];

							// Renvoie un tableau contenant quelques personnages d'une maisonF
							function getNewInputs(codeJour) {
							    switch (codeJour) {
							    case "LUN":
							        return ["lundi-1", "lundi-2"];
							    case "MAR":
							        return ["mardi-1", "mardi-2"];
							    case "MER":
							        return ["mercredi-1", "mercredi-2"];
							    case "JEU":
							        return ["jeudi-1", "jeudi-2"];
							    case "VEN":
							        return ["vendredi-1", "vendredi-2"];
							    case "SAM":
							        return ["samedi-1", "samedi-2"];
							    case "DIM":
							        return ["dimanche-1", "dimanche-2"];
							    default:
							        return [];
							    }
							}

							// Crée et renvoi un élément HTML <input> de type checkbox
							function createInputCheckbox(val1, val2) {
							    var newInput = document.createElement('input');
								newInput.setAttribute('type', 'checkbox');
								newInput.setAttribute('name', val2);
								newInput.setAttribute('value', val1);
							    return newInput;
							}

							// Crée et renvoi un élément HTML <input> de type text
							function createInputNumber(val) {
							    var newInput = document.createElement('input');
								newInput.setAttribute('type', 'number');
								newInput.setAttribute('name', val);
								newInput.setAttribute('min', 0);
								newInput.setAttribute('max', 23);
								newInput.required = true;
							    return newInput;
							}

							var inputs = document.getElementById("jours"); // équivalent à var inputs = document.querySelector("#jours");
							// Remplit la liste des jours
							jours.forEach(function (jour) {
								inputs.appendChild(document.createTextNode(jour.nom));
							    inputs.appendChild(createInputCheckbox(jour.code, jour.nom));
							    inputs.appendChild(document.createElement('br'));
							});

							inputs.addEventListener("click", function (e) {		
								var jours = getNewInputs(e.target.value);
								console.log(e.target.value);
								var dispos = document.getElementById("disponibilites");

								console.log(jours);

								if (typeof e.target.name !== 'undefined'){

									console.log(e.target.checked)

									if(e.target.checked){

										var index=0;

										// p correspond à chaque ligne html qui sera rajoutée lorsque qu'on coche un jour
										// On ajoute p à chaque div correspondant au jour pour pouvoir y accéder facilement pour la suppression

										var p = document.createElement("p");
										var div = document.getElementById(e.target.value);
									   	//p.id=e.target.value;

										p.appendChild(document.createTextNode(e.target.name.concat(" : De ")));

									    jours.forEach(function (dispo) {

									    	if (index == 0){
									    		p.appendChild(createInputNumber(dispo));
									    		p.appendChild(document.createTextNode(" H à "));
									    	}
									    	else{
									    		p.appendChild(createInputNumber(dispo));
									    		p.appendChild(document.createTextNode(" H\n"));
									    	}

									    	dispos.appendChild(p);
									        index+=1;
									       
									    });

									    div.appendChild(p);

									}
									else{
										// On supprime le contenu de la div correspondant au jour que l'on décoche

										var element = document.getElementById(e.target.value);
										while (element.firstChild) {
										  element.removeChild(element.firstChild);
										}
									}
							    }

							});

						</script>
                        
                        <!--Lundi : De <input type="number" name="lundi-1" min="0" max="23"> H à <input type="number" name="lundi-2" min="0" max="23"> H
                        Mardi : De <input type="number" name="mardi-1" min="0" max="23"> H à <input type="number" name="mardi-2" min="0" max="23"> H
                        Mercredi : De <input type="number" name="mercredi-1" min="0" max="23"> H à <input type="number" name="mercredi-2" min="0" max="23"> H
                        Jeudi : De <input type="number" name="jeudi-1" min="0" max="23"> H à <input type="number" name="jeudi-2" min="0" max="23"> H
                        Vendredi : De <input type="number" name="vendredi-1" min="0" max="23"> H à <input type="number" name="vendredi-2" min="0" max="23"> H
                        Samedi : De <input type="number" name="samedi-1" min="0" max="23"> H à <input type="number" name="samedi-2" min="0" max="23"> H
                        Dimanche : De <input type="number" name="dimanche-1" min="0" max="23"> H à <input type="number" name="dimanche-2" min="0" max="23"> H
                    	-->

                        <br> <br>
                		
                		<input type="submit" value="Valider" />
                    
    </fieldset>
</form>            
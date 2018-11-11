<form action="Upload_traiter.php" method="post" enctype="multipart/form-data">

                        <div> 
                            <label for="motClef"> Catégorie du bien : </label> 
                            <select name="motClef" id="motClef">
                                <option value="null">Choissisez la catégorie</option>
                                <optgroup label ="Multimedia">
                                    <option value="informatique">Informatique</option>
                                    <option value="console-jv">Console & Jeux vidéos</option>
                                    <option value="image-son">Image & Son</option>
                                    <option value="telephonie">Téléphonie</option>
                                </optgroup>
                                <optgroup label ="Loisirs">
                                 <option value="dvd-films">DVD/Films</option>
                                </optgroup>
                                ...
                            </select>
                        </div>   

                        <div>
                            Titre de l'annonce :
                            <input type="text" name="titre" required />
                        </div> 

                        <div>
                            <label for="description"> Description du bien : </label>
                            <textarea name="description" rows="8" cols="45">
                            </textarea>
                        </div> 
                        
                        <div>
                            Prix neuf du bien :
                            <input type="text" name="prixNeuf" required /> €
                        </div> 

                        <div>
                            Photo du bien :<br />
                            <input type="file" name="photo" required /><br />
                        </div> 
                        
                    <input type="submit" value="Valider" />
                        
</form>
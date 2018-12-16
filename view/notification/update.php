<?php

switch ($functionCaller) {
    case "create":
        $formTitle="Envoyer un message aux Administrateurs";
        $hiddenValue="created";
        $attribut = " ";
        $admin = "idMembre";
        $idNotif = "";
        break;
    case "reponse":
        $formTitle="Envoyer une réponse";
        $hiddenValue="repondu";
        $attribut="readonly";
        $admin= "idAdmin";
                $idNotif = htmlspecialchars($n->getIdNotif());
                $idMembre = htmlspecialchars($n->getIdMembre());
                echo 'Message de  : '.ModelMembre::getLoginById($idMembre);
                $message = htmlspecialchars($n->getMessage()); 
                $idAdmin = htmlspecialchars($n->getIdAdmin()); 
                $reponse = htmlspecialchars($n->getReponse());
                $estRegle = htmlspecialchars($n->getEstRegle());
        break;
}

?>


<form action="index.php" method="get" enctype="multipart/form-data">
     <fieldset>
         <legend><?=$formTitle?></legend>
    <input type='hidden' name='controller' value='Notification'>
    <input type='hidden' name='action' value='<?=$hiddenValue?>'>
    <input type='hidden' name='idNotif' value='<?=$idNotif?>'>
    <input type='hidden' name='<?php echo $admin?>' value='<?=ModelMembre::getidByLogin($_SESSION['login'])?>'>
   
        

                    
                        <div>
                            <label for="message">Message : </label><textarea name="message" rows="8" cols="45" required readonly="<?$attribut?>" > <?php if($functionCaller == "reponse")echo $message?></textarea>
                        </div> 
    
                       <?php
                       if($functionCaller == "reponse"){
                       echo '
                       <div>
                            <label for="reponse">Reponse : </label><textarea name="reponse" rows="8" cols="45" required ></textarea>
                        </div>  ';
                       }
                               ?>

                    <input type="submit" value="Valider" />
                
                    
    </fieldset>
</form>            

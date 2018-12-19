<div>
    <?php 
        if(Conf::getDebug()==false){
        $method = "post";
    }else{
        $method = "get";
    }
?>
<form method="<?$method?>" action="index.php">
    <fieldset id ="formulaire_connex">
        <?php if(isset($functionCaller)){
                if($functionCaller=='connect'){
                    echo '<legend><b>Se connecter : </b></legend>';
        }
        }
        ?>
        <input type="hidden" name="controller" value="membre">
        <input type="hidden" name="action" value="connected">
        <p>
            <label for="log_id">Login :</label> 
            <input type="text" name="login" id="log_id" required />
            </p>
            <p>
            <label for="mdp_id">Mot de passe :</label> <input type="password" name="mdp" id="mdp_id" required/> 
            <br>
            <br>
            <input type="submit" value="Se connecter" />
            </p>
       
     
       
    </fieldset>
</form>
</div>
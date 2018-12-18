    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align">
            <a href="index.php" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Accueil</a>

            <div class="w3-dropdown-hover w3-hide-small">
            <button class="w3-button" href="#">Biens <i class="fa fa-caret-down"></i></button>   
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">  
                                <a href="index.php?controller=bien&action=readAll" class="w3-bar-item w3-button">Trouver un bien</a>
    							<?php
    							if((isset($_SESSION['login'])))
                                    echo '<a href="index.php?controller=bien&action=create" class="w3-bar-item w3-button">Proposer un bien</a>';
    							?>
                </div>
            </div>


            <div class="w3-dropdown-hover w3-hide-small">
            <button class="w3-button" href="#">Services <i class="fa fa-caret-down"></i></button>  
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">   
    			<a href="index.php?controller=service&action=readAll" class="w3-bar-item w3-button">Trouver un service</a>
    			<?php
    			if((isset($_SESSION['login'])))
                    echo '<a href="index.php?controller=service&action=create" class="w3-bar-item w3-button">Proposer un service</a>';
    		      ?>	

                </div>
            </div>


            <div class="w3-dropdown-hover w3-hide-small">
            <button class="w3-button" href="#">Membres <i class="fa fa-caret-down"></i></button>  
                <div class="w3-dropdown-content w3-card-4 w3-bar-block"> 
    							<a href="index.php?controller=membre&action=readAll" class="w3-bar-item w3-button">Trouver un membre</a>

                </div>
            </div>

    		<?php 
    			         if((!isset($_SESSION['login']))){
                                                 
    						echo 
                            '<a href="index.php?controller=membre&action=connect" class="w3-bar-item w3-button">S\'identifier</a>'
    					    .'<a href="index.php?controller=membre&action=create"class="w3-bar-item w3-button">S\'inscrire</a>';
                                                    
                        }
                        else{
                        	echo '<div class="w3-dropdown-hover w3-hide-small">
                                        <button class="w3-button" href="#">'.$_SESSION["login"].'<i class="fa fa-caret-down"></i></button>  
                                            <div class="w3-dropdown-content w3-card-4 w3-bar-block">';

                    						echo '<a href="index.php?controller=membre&action=read&login='.$_SESSION['login'].'" class="w3-bar-item w3-button" >Mes informations personnelles</a>';
                                            echo '<a href="index.php?controller=bien&action=readAllByMembre" class="w3-bar-item w3-button">Mes biens</a>';
                                            echo '<a href="index.php?controller=service&action=readAllByMembre" class="w3-bar-item w3-button">Mes services</a>';
                                            if (Session::is_admin()){
                                                echo '<a href="index.php?controller=membre&action=gestionAnnonces" class="w3-bar-item w3-button">Gestion des annonces</a>';
                                                echo '<a href="index.php?controller=notification&action=readAll" class="w3-bar-item w3-button">Gestion des notifications</a>';
                                                }
                                            else 
                                                echo '<li><a href="index.php?controller=notification&action=readAll" class="w3-bar-item w3-button">Messagerie</a>';
                                                echo '<a href="index.php?controller=membre&action=deconnect" class="w3-bar-item w3-button">Se déconnecter</a>';
                                            }

                            echo '</div> </div>';

                            if((isset($_SESSION['login'])))
                            echo '<a class="w3-bar-item w3-button w3-hide-small w3-hover-white" href="index.php?controller=notification&action=create">Contact</a>';
                        ?>
             </div>           
        </div>


<br>

<!--
Navbar
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Accueil</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Bien</a>
  <a href="#work" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Services</a>
  <a href="#pricing" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Membre</a>
  <a href="#contact" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
    <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button" title="Notifications">Dropdown <i class="fa fa-caret-down"></i></button>  
    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
      <a href="#" class="w3-bar-item w3-button">Link</a>
      <a href="#" class="w3-bar-item w3-button">Link</a>
      <a href="#" class="w3-bar-item w3-button">Link</a>
    </div>
  </div>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal" title="Search"><i class="fa fa-search"></i></a>
 </div>
</div>

 Image Header 


-->
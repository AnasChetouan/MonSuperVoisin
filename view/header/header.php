<nav>
    <div class="menuprinci" style="padding:1.5%;">
        <a class="logo" href="index.php"><img class="logo2" src="style/img/v.png" alt="logo"></a>
        <div>
        <li class="menu-biens"><a href="#">Biens</a>
						<ul class="submenu">
							<li><a href="index.php?controller=bien&action=readAll">Trouver un bien</a></li>
							<?php
							if((isset($_SESSION['login'])))
                                echo '<li><a href="index.php?controller=bien&action=create">Proposer un bien</a></li>';
							?>		
						</ul>
					</li>
                                        </div>
		<div>
					<li class="menu-services"><a href="#">Services</a>
						<ul class="submenu">
							<li><a href="index.php?controller=service&action=readAll">Trouver un service</a></li>
							<?php
							if((isset($_SESSION['login'])))
                                echo '<li><a href="index.php?controller=service&action=create">Proposer un service</a></li>';
							?>	
						</ul>
					
					</li>
                                        </div>
        		<div>
					<li class="menu-membres"><a href="#">Membres</a>
						<ul class="submenu">
							<li><a href="index.php?controller=membre&action=readAll">Trouver un membre</a></li>
						</ul>
					
					</li>
                                        </div>
                                        <div>
					<?php 
					if((!isset($_SESSION['login']))){
                                             
						echo '<li class="menu-connexion"><a href="index.php?controller=membre&action=connect">S\'identifier</a></li></div><div>'
						 .'<li class ="menu-inscription"><a href="index.php?controller=membre&action=create">S\'inscrire</a></li>';
                                                 echo '</div>';
                                                
                                            }
                    else{
                    	echo "<li class='menu-profil'><a href='#'>".$_SESSION['login'];
                    
                        echo "</a>";
                    	echo "<ul class='submenu'>";
						echo '<li><a href="index.php?controller=membre&action=read&login='.$_SESSION['login'].'">Mes informations personnelles</a></li>';
                                                echo '<li><a href="index.php?controller=bien&action=readAllByMembre">Mes biens</a></li>';
                                                echo '<li><a href="index.php?controller=service&action=readAllByMembre">Mes services</a></li>';
                                                if (Session::is_admin()){
                                                echo '<li><a href="index.php?controller=membre&action=gestionAnnonces">Gestion des annonces</a></li>';
                                                echo '<li><a href="index.php?controller=notification&action=readAll">Gestion des notifications</a></li>';
                                                }
                                                else echo '<li><a href="index.php?controller=notification&action=readAll">Messagerie</a></li>';
                                                echo '<li><a href="index.php?controller=membre&action=deconnect">Se déconnecter</a></li>';
                        echo '</ul>';
                    	echo '</li>';
                    }
                    echo '</div>';
                    echo '<div>';
                        if((isset($_SESSION['login'])))
                        echo '<li class="menu-contact"><a href="index.php?controller=notification&action=create">Contact</a></li>

				</ul>';
                    ?>
        </div>
    </div>
    
</nav>    


<br>
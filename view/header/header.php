<nav id =menu>
				<ul>

					<li class="menu-biens"><a href="#">Biens</a>
						<ul class="submenu">
							<li><a href="index.php?controller=bien&action=readAll">Trouver un bien</a></li>
							<?php
							if((isset($_SESSION['login'])))
                                echo '<li><a href="index.php?controller=bien&action=create">Proposer un bien</a></li>';
							?>		
						</ul>
					</li>
		
					<li class="menu-services"><a href="#">Services</a>
						<ul class="submenu">
							<li><a href="index.php?controller=service&action=readAll">Trouver un service</a></li>
							<?php
							if((isset($_SESSION['login'])))
                                echo '<li><a href="index.php?controller=service&action=create">Proposer un service</a></li>';
							?>	
						</ul>
					
					</li>

					<?php 
					if((!isset($_SESSION['login']))){
						echo '<li class="menu-connexion"><a href="index.php?controller=membre&action=connect">S\'identifier</a></li>'
						 .'<li class ="menu-inscription"><a href="index.php?controller=membre&action=create">S\'inscrire</a></li>';
                                            }
                    else{
                    	echo "<li class='menu-profil'><a href='#'>".$_SESSION['login'];
                    	if (Session::is_admin()){
                        	echo ' (Admin)';
                        }
                        echo "</a>";
                    	echo "<ul class='submenu'>";
						echo '<li><a href="index.php?controller=membre&action=read&login='.$_SESSION['login'].'">Mon profil</a></li>';
						echo '<li><a href="index.php?controller=membre&action=deconnect">Se déconnecter</a></li>';
                                                echo '<li><a href="index.php?controller=bien&action=readAllByMembre">Mes Biens</a></li>';
                                                if (Session::is_admin()){
                                                echo '<li><a href="index.php?controller=membre&action=gestionAnnonces">Gestion des Annonces</a></li>';
                                                echo '<li><a href="index.php?controller=notification&action=readAll">Gestion des Notifications</a></li>';
                                                }
                                                else echo '<li><a href="index.php?controller=notification&action=readAll">Mes Messsages</a></li>';
                        echo '</ul>';
                    	echo '</li>';
                    }
                    
                        if((isset($_SESSION['login'])))
                        echo '<li class="menu-contact"><a href="index.php?controller=notification&action=create">Contact</a></li>

				</ul>';
                    ?>

</nav>

<br>
<nav id = menu>
				<ul>

					<li><a href="#">Biens</a>
						<ul>
							<li><a href="index.php?controller=bien&action=readAll">Trouver un bien</a></li>
							<?php
							if((isset($_SESSION['login']))){
                                echo '<ul id="list_menu">' . '<a href="index.php?controller=bien&action=create">Proposer un bien</a>'
                                                        . '</ul>';
                                                    }
							?>
							
						</ul>
					</li>
		
					<li><a href="#">Services</a>
						<ul>
							<li><a href="#">Trouver un service</a></li>
						</ul>
					
					</li>
					<li>
                                            <?php 
                                            if((!isset($_SESSION['login']))){
                                                echo '<a href="index.php?controller=membre&action=connect">Connexion</a>'
                                                .'<ul id="list_menu">' . '<a href="index.php?controller=membre&action=create">Iscription</a>'
                                                        . '</ul>';
                                            }else echo '<a href="index.php?controller=membre&action=read&login='.$_SESSION['login'].'">Mon Profil </a>';
                                            ?>
                                                <?php 
                                                if((isset($_SESSION['login']))){
                                                    echo '<ul id="list_menu">';
						    echo '<li><a href="index.php?controller=membre&action=deconnect">Deconnexion</a></li>';
                                                    echo '</ul>';
                                                }
                                                ?>
					</li>
	
					<li><a href="#">Contact</a></li>

				</ul>


			</nav>
<br>
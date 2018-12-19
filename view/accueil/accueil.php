<!--<img class ="centrer" src='style/img/v.png' alt="logo" height="10%" width="10%" >
<p id="nom_site">MonSuperVoisin </p> -->

<body id="myPage">


<!-- Modal -->

	        <div class="w3-display-container w3-animate-opacity">
          <img src="style/img/montpellier.jpg" alt="bg" style="width:100%;min-height:350px;max-height:600px;">
          <div class="w3-container w3-display-bottomleft w3-margin-bottom">  
            <a <button href="index.php?controller=membre&action=create" class="w3-button w3-xlarge w3-theme w3-hover-teal" title="S'inscrire">Inscrivez-vous dès maintenant !</button></a>
          </div>
        </div>

<!-- Denières annoces -->

<div class="w3-container w3-padding-64 w3-center" id="team">
<h2>Les dernières annonces</h2>
<p>Les biens :</p>

<div class="w3-row"><br>

<?php
	$tab_b = ModelBien::selectAll();
    $taille = sizeof($tab_b);
    for($i = $taille; $i>0 ; $i--){
    	$b = $tab_b[$i-1];

    	echo '<div class="w3-quarter">
			  <img src="'.$b->getLienPhoto().'" alt="Bien" style="width:35%;height:100%" class="">
			  <h3> <a href=index.php?controller=bien&action=read&idBien='.$b->getIdBien().'>'.$b->getTitre().'</a></h3>
			  <p>Par : <b> '.ModelMembre::getLoginById($b->getIdProprio()).'</b></p>
			</div>';

    }
            
?>	<div class="w3-row"><br>

	<p>Les services :</p>

	<?php
	$tab_s = ModelService::selectAll();
    $taille = sizeof($tab_s);
    for($i = 1; $i<5 ; $i++){
    	$s = $tab_s[$taille-$i];

    	echo '<div class="w3-quarter">
			  <img src="style/img/service.png" alt="Service" style="width:35%;height:100%" class="">
			  <h3> <a href=index.php?controller=service&action=read&idService='.$s->getIdService().'>'.$s->getMotClef().'</a></h3>
			  <p>Par : <b> '.ModelMembre::getLoginById($s->getIdProprio()).'</b></p>
			</div>';

    }

    ?>
<br>

</div>

</div>

</div>


<!-- Footer -->
<footer class="w3-container w3-padding-32 w3-theme-d1 w3-center">
  <h4>Suivez-nous</h4>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-google-plus"></i></a>
  <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-instagram"></i></a>
  <a class="w3-button w3-large w3-teal w3-hide-small" href="javascript:void(0)" title="Linkedin"><i class="fa fa-linkedin"></i></a>
  <p>Design par <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>

  <div style="position:relative;bottom:100px;z-index:1;" class="w3-tooltip w3-right">
    <span class="w3-text w3-padding w3-teal w3-hide-small">Remonter</span>   
    <a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>
</footer>

<script>
// Script for side navigation
function w3_open() {
    var x = document.getElementById("mySidebar");
    x.style.width = "300px";
    x.style.paddingTop = "10%";
    x.style.display = "block";
}

// Close side navigation
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
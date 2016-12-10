<?php 
include_once 'arretDAO.php';
include_once 'arretAPP.php';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/tan.jpg">
    <link rel="stylesheet" type="text/css" href="css/tan.css">

    <title>Tan helper</title>

  </head>

  <body>
    <div class="container">
<!--       <div class="starter-template"> -->
        <div class="bordered-main">
	        <h1 class="bg-primary menu-titre">Arr&ecirc;ts</h1>
	        <div id="menu" class="row">
		        
		        <div class="col-md-4 col-b-2 menu-titre" >
			        <div class="bordered-secondary">
			        	<h3 class="bg-info menu-titre">Arr&ecirc;ts proches</h3>
				        <div class="alert alert-danger" id="alerteGPS" role="alert"> <img src="img/loading.gif"/> Recherche GPS en cours...</div>
				        <div id="arretGeo"> </div>
			        </div>
		        </div>
		        
		        <div id="arretAll" class="col-md-4"> 
			        <div class="bordered-secondary">
			        	<h3 class="bg-info menu-titre">Arr&ecirc;t liste</h3>
				        <div class="ui-widget">
						  <input id="inputArretAll" type='text' placeholder="Cherchez votre arr&ecirc;t">
						  <button id="buttonArretAll" type='button' class='btn btn-sm btn-info' onclick='getTempsAttente(this);'>Valider</button>
						</div>
			        </div>
		        </div>
	        
		        <div class="col-md-4">
			        <div class="bordered-secondary">
			       		<h3 class="bg-info menu-titre"> Arr&ecirc;ts r&eacute;cents</h3>
			       		<div id="arretFav"> </div>
			        </div>
		        </div>
		        
	        </div>
        </div>
        
        <br/>
        <div class="bordered-main">
	        <h1 class="bg-primary menu-titre">Horaires</h1>
	        
	        <div class="row" >
	        	<div class="alert alert-danger col-md-12" id="alerteHoraires" role="alert" style="display:none"> <img src="img/loading.gif"/> Recherche horaires en cours...</div>
	        </div>
	        
	        <div class="row"> 
	        	<div id="tempsAttente" class="col-md-12"> </div>
	        </div>
	<!--         <div id="tempsAttente" class='row jumbotron'> </div> -->
	   </div>

    </div><!-- /.container -->

	
	<!--  JQUERY  -->
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
    <!-- APP JS -->
    <script type="text/javascript" src="js/geolocalisation.js"></script>
    
	<!-- INLINE JS -->
	<script>
	$(function() {
    	<?php
			$arretDAO = new ArretDAO();
    		$listJson = $arretDAO->getArretsToJson();
    		
    	?>
    	var availableTags = <?php echo($listJson) ?>;
		$( "#inputArretAll" ).autocomplete({
			source: availableTags,
		    select: function( event, ui ) {
		    	$( "#inputArretAll" ).val( ui.item.value );
		    	$( "#buttonArretAll" ).attr( "codeLieu", ui.item.codeLieu );
		        return false;
		      }
		});
	});
	</script>
  </body>
</html>






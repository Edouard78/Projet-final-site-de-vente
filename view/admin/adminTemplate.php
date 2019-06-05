<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
	  <meta charset="UTF-8">
        <title>STYLE SHOP - Site de vente - Mode et vétements</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Style Shop est un site de vente de vétements avec des grandes marques tendances">
        <meta name="keywords" content="style shop vente vétements marques tendances brice armor lux">
        <meta name="author" content="Edouard Joltreau">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="public/css/base.css">
        <link rel="stylesheet" type="text/css" href="public/css/layout.css">
        <link rel="stylesheet" type="text/css" href="public/css/module/module.css">
        <link rel="stylesheet" type="text/css" href="public/css/module/chargeStyle.css">
        <script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js'></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  	<script>tinymce.init({ selector:'.tinymce' });</script>
</head>

<body class='body' style='padding-top: 15vh !important;'>
 
	<nav>
		<div class="nav">
			<?php require_once( '/../nav.php'); ?>
		</div>
	</nav>

    <nav>
		<div class="second-nav">
		
		</div>
	</nav>

	<main class='l-main'>
	<div class="container">
   	<div class = "row">

    <nav class="nav flex-column nav-tabs align-content-center col-md-3" style='min-height:100%;'>
    <h3>Tableau de bord</h3>
 				<li class="nav-user "> <a class="nav-link " href="index.php?action=adminPage">Commandes</a> </li>
                <li class="nav-user "> <a class="nav-link " href="index.php?action=catalog">Catalogue</a> </li>
                <li class="nav-user"> <a class="nav-link" href="index.php?action=adminClients">Clients</a> </li>

                <li class="nav-user"> <a class="nav-link" href="index.php?action=statisticsAdmin">Stats</a> </li>
	</nav>
		<div class="content col-md-9">
		<?php echo $content ?>
		</div>
	</div>
</div>
</main>
	       <footer class='l-footer footer'>
            <div class="jumbotron footer-jumbotron">
            <div class="container-fluid">
                <div class="row">
                    <div class="footer-social-media col"> 
                        <h3>Suivez nous<h3>
                        <em class="fa fa-facebook">
                        </em>
                        <em class="fa fa-twitter">
                        </em>
                        <em class="fa fa-skype">
                        </em>
                        <em class="fa fa-instagram">
                        </em>
                    </div>
                    <div class="aPropos col">
                    <h3>A propos de STYLSHOP</h3>
                    <ul>
                        <li>À propos</li>
                            <li>Conditions d'utilisation</li>
                            <li>Paiement</li>
                            <li>Protection des données</li>
                    </ul>	
                    </div>
                </div>
            </div>
        </footer>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">
    <head>
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
    </head>
    <body class='body' style='padding-top: 15vh !important;'>
        <nav>
        	<?php require_once ('nav.php'); ?>
        </nav>

        <main class='l-main'>
        	<div class="container">
            	<?php echo $content ?>
       		</div>
    	</main>

        <footer class='l-footer footer'>
            <div class="jumbotron footer-jumbotron">
            <div class="container-fluid">
                <div class="row">
                    <div class="footer-social-media col"> 
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
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="./public/js/charge.js"></script>
    </body>
</html>
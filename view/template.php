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
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<link rel="stylesheet" type="text/css" href="public/css/chargeStyle.css">

</head>

<body>
  <div class="wrap">
	    <nav>
		    <div class="nav">
			    <?php require_once( 'nav.php'); ?>
	  	  </div>
			</nav>

	    <div class="container">
	    	<div class="content">
	    	  <?php echo $content ?>
				</div>
			</div>

  </div>
	
	<footer id="footer">
	  <div class="jumbotron jumbotron-footer">
		  <div class="container-fluid">
				<div class="footerBlock row">
					<div class="social-media col"> <em class="fa fa-facebook"></em>
						<em class="fa fa-twitter"></em>
						<em class="fa fa-skype"></em>
			  		<em class="fa fa-instagram"></em>
					</div>

			  	<div class="aPropos col">		
					</div>
					
				</div>
			</div>

	</footer>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script src="https://js.stripe.com/v3/"></script>
	<script src="./public/js/charge.js"></script>

</body>

</html>
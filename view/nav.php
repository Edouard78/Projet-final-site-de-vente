<div class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

<a class="navbar-brand" href="#"><h2 class='site-title'>STYLE SHOP</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">

  <ul class="navbar-nav">
    <li class="nav-item"> <a class="nav-link" href="index.php?action=home">ACCUEIL</a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">HOMME</a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">FEMME</a> </li>
  </ul>
  <ul class="navbar-nav ml-auto">
  <li class="nav-item"><a class="nav-link" href="index.php?action=checkoutPage">Panier</a></li>
  <?php if (isset($_SESSION['login']) && isset($_SESSION['admin']))
  	{ 
  		if($_SESSION['admin'] == TRUE){ ?>
  		<li class="nav-item"><a class="nav-link" href="index.php?action=adminPage">Espace Admin</a></li>
  		<?php
         }
      elseif($_SESSION['admin'] == FALSE)
      { ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=userPage">Mon Compte</a></li>
          <?php
    }
  }
  	else
  	{ 
  		?>
  	 <li class="nav-item"><a class="nav-link" href="index.php?action=authenticationPage">Connection</a></li>
  	 <?php
  	}
 ?>
  	</ul>

  </div>
  </div>

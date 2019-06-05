<div class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
<a class="navbar-brand" href="#"><h2 class='website-title'>STYLE SHOP</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-between align-items-center" id="collapsibleNavbar">

  <ul class="navbar-nav">
    <li class="nav-item"> <a class="nav-link" href="index.php?action=home">ACCUEIL</a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">VÊTEMENTS</a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">ACCESOIRES</a> </li>
  </ul>
  <ul class="navbar-nav">
  <li class="nav-item"><a class="cart-link nav-link" href="index.php?action=cartPage"><i class="fa fa-shopping-cart nav-icon cart-icon"></i>Panier</a></li>
  <?php if (isset($_SESSION['login']) && isset($_SESSION['admin']))
  	{ 
  		if($_SESSION['admin'] == TRUE){ ?>
        <li class="nav-item"><a class="nav-link" href="index.php?action=signOut"><i class="fa fa-user nav-icon"></i>Se Deconnecter</a></li>
  		<li class="nav-item"><a class="nav-link" href="index.php?action=adminPage" style='line-height: 2.49em;'><span style='padding-right: 0.5em;'>|</span>Espace Admin</a></li>
  		<?php
         }
      elseif($_SESSION['admin'] == FALSE)
      { ?>
        <li class="nav-item"><a class="nav-link" href="index.php?action=signOut"><i class="fa fa-user nav-icon"></i>Se Deconnecter</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=userPage" style='line-height: 2.49em;'><span style='padding-right: 0.5em;'>|</span>    <?php echo ucfirst($_SESSION['login']); ?></a></li>
          <?php
    }
  }
  	else
  	{ 
  		?>
  	 <li class="nav-item"><a class="nav-link" href="index.php?action=authenticationPage"><i class="fa fa-user nav-icon"></i>Se Connecter</a></li>
  	 <?php
  	}
 ?>
  	</ul>

  </div>
  </div>

<?php
  if (isset($_SESSION['cart'])) {
    echo '<style>.cart-icon {color:DeepSkyBlue ;} .cart-link {color:DeepSkyBlue !important ;} 
</style>';

  }
<?php
require_once ('/../model/item.php');

require_once ('/../model/user.php');

require_once ('/../model/userManager.php');

require_once ('/../model/userShippingAdress.php');


function home()
	{
    include ('/../model/db.php');
    
	require ('/../view/homeView.php');

	}

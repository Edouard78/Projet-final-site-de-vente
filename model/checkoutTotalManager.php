<?php

class CheckoutTotalManager
{

	public function saveTotal($checkoutTotal)
	{



        $_SESSION['checkoutTotal'] = $checkoutTotal;



	}


}
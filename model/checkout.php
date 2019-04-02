<?php

class Checkout
{

	public function addItem($item)
	{

        if(isset($_SESSION['itemsCheckout']))
        {
       
            
                array_push($_SESSION['itemsCheckout'], $item);
        }
        else{
                
    
        $_SESSION['itemsCheckout'] = [];
        array_push($_SESSION['itemsCheckout'], $item);
        }
        

        var_dump($_SESSION['itemsCheckout']);

	}




}

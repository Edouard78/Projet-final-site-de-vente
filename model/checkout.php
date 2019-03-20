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
                
        session_start();
        $_SESSION['itemsCheckout'] = [];
        array_push($_SESSION['itemsCheckout'], $item);
        }
        

        var_dump($_SESSION['itemsCheckout']);

	}


	public function removeItem($id){
        if (in_array($id, $_SESSION['itemIdCheckout']) )
        {
        session_id($id);
        session_destroy();
        }
	}


}

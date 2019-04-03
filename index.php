<?php
require_once ('model/checkoutItem.php');

require_once ('model/checkoutTotal.php');
session_start();
require ('controller/controller.php');



try {
    if (isset($_GET['action']))
        {
            if ($_GET['action'] == 'home')
            {
                home();
            } 

            elseif ($_GET['action'] == 'proceedCheckout')
            {

         
                paymentPage();
    
            }

            elseif ($_GET['action'] == 'checkoutPage')
            {

         
                checkoutPage();
    
            }

            elseif ($_GET['action'] == 'updateItemCheckout' && isset($_GET['itemCheckoutId']) && isset($_POST['quantity']) )
            {


                if (isset($_SESSION['itemsCheckout']))
                {
                    
                    
                    $_SESSION['itemsCheckout'][$_GET['itemCheckoutId']]->updateQuantity($_POST['quantity']);

                    $_SESSION['checkoutTotal']->updateTotal($_SESSION['itemsCheckout']);


                    checkoutPage();
            
                }
    
            }

            elseif ($_GET['action'] == 'deleteItemCheckout' && isset($_GET['id']) && isset($_GET['id']) )
            {

                
                if (isset($_SESSION['itemsCheckout']))
                {
                 unset($_SESSION['itemsCheckout'][$_GET['id']]);
                 
                 $_SESSION['checkoutTotal']->updateTotal($_SESSION['itemsCheckout']);

                 checkoutPage();
                }    
    
            }


            elseif ($_GET['action'] == 'addItemCheckout' && isset($_POST['quantity']) && isset($_GET['id']) && isset($_GET['price']))
            {

                $data = array("id"=>$_GET['id'], "quantity" => $_POST['quantity'], "price" =>$_GET['price'] );
            checkoutAdd($data);
    
            }

            elseif ($_GET['action'] == 'connexion' && isset($_POST['login']))
            {
            $login = $_POST['login'];
            $password = $_POST['password'];
            authentication($login, $password);
    
            }

            elseif ($_GET['action'] == 'authenticationPage')
            {
                authenticationPage();
            } 

            elseif ($_GET['action'] == 'subscribe' && isset($_POST['login']))
		{
		$data1 = array(
			'login' => $_POST['login'],
			'password' => $_POST['password'],
			'password2' => $_POST['password2'],
			'email' => $_POST['email']
        );
        
        $data2 = array(
			'name' => $_POST['name'],
			'adress' => $_POST['adress'],
			'postalCode' => $_POST['postalCode'],
			'city' => $_POST['city']
        );
        
		subscribe($data1, $data2);
		}
	elseif ($_GET['action'] == 'subscribePage')
		{
		subscribePage();
		}


        
            elseif ($_GET['action'] == 'addItem' && isset($_POST['title']))
		{
            $itemImg = $_FILES['itemImg'];
            
            $itemImgTmpName = $_FILES['itemImg']['tmp_name'];
            $itemImgName = $_FILES['itemImg']['name'];

		$data = array(
			'title' => $_POST['title'],
			'brand' => $_POST['brand'],
			'content' => $_POST['description']
		);
		addItem($data, $itemImg, $itemImgTmpName, $itemImgName);
		
        }
        
        elseif ($_GET['action'] == 'addItemPage')
		{
		addItemPage();
		
        }
        
        elseif ($_GET['action'] == "itemUnique")
	{
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		itemUnique($_GET['id']);
		}
	else
	{
		throw new Exception('Aucun identifiant de billet envoyé');
	}
}

        }

    
    else
        {
            home();
        }

    }

catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}

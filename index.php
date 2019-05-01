<?php
require_once ('model/cart.php');
require_once ('model/cartProduct.php');

session_start();
require ('controller/controller.php');



try {
    if (isset($_GET['action']))
        {
            if ($_GET['action'] == 'home')
            {
                home();
            } 

            elseif ($_GET['action'] == 'submitCart')
            {

                if (isset($_SESSION['userId']) & isset($_SESSION['login']) )
                {
                    $userId = $_SESSION['userId'];

                    prePaymentPage($userId);
                }

                else{
                    echo 'Vous nete pas connecté';
                }

    
            }

            elseif ($_GET['action'] == 'submitOrderInfos')
            {

                if (isset($_POST['userShippingAdress']))
                {
                    $userShippingAdressId = $_POST['userShippingAdress'];
                    if (isset($_POST['billing-adress-identical'])) {

                    $userBillingAdress = 'sameAs';

                    }
                    
                    submitOrderInfos($userShippingAdressId, $userBillingAdress);
            
                }

                else{
                    echo 'Vous nete pas connecté';
                }

    
            }

            elseif ($_GET['action'] == 'cartPage')
            {

         
                cartPage();
    
            }

            elseif ($_GET['action'] == 'updateProductCart' && isset($_GET['productCartId']) && isset($_POST['quantity']) )
            {


                if (isset($_SESSION['cart']))
                {
                    
                    
                    $_SESSION['cart']->products()[$_GET['productCartId']]->updateQuantity($_POST['quantity']);

                    $_SESSION['cart']->updateTotalPrice();


                    cartPage();
            
                }
    
            }

            elseif ($_GET['action'] == 'deleteProductCart' && isset($_GET['id']) && isset($_GET['id']) )
            {

                
                if (isset($_SESSION['cart']))
                {
                 $_SESSION['cart']->deleteProduct($_GET['id']);
                 
                 $_SESSION['cart']->updateTotalPrice();

                 if (count($_SESSION['cart']->products()) == 0){
                     unset($_SESSION['cart']);
                 }

                 cartPage();
                }    
    
            }


            elseif ($_GET['action'] == 'addProductToCart' && isset($_POST['quantity']) && isset($_GET['id']) && isset($_GET['price']))
            {

                $data = array("id"=>$_GET['id'], "quantity" => $_POST['quantity'], "price" =>$_GET['price'] );
            addProductToCart($data);
    
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


        
            elseif ($_GET['action'] == 'addProduct' && isset($_POST['title']))
		{
            $productImg = $_FILES['productImg'];
            
            $productImgTmpName = $_FILES['productImg']['tmp_name'];
            $productImgName = $_FILES['productImg']['name'];

		$data = array(
			'title' => $_POST['title'],
            'brand' => $_POST['brand'],
            'price' => $_POST['price'],
			'content' => $_POST['description']
		);
		addProduct($data, $productImg, $productImgTmpName, $productImgName);
		
        }
        
        elseif ($_GET['action'] == 'addProductPage')
		{
		addProductPage();
		
        }
        
        elseif ($_GET['action'] == "productUnique")
	{
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		productUnique($_GET['id']);
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

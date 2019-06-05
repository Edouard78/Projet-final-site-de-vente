<?php
require_once ('model/cart.php');
require_once ('model/cartProduct.php');

session_start();
require ('controller/controller.php');




try {
    if (isset($_GET['action']))
        {
            if ($_GET['action'] == 'home' && !isset($_GET['page']))
            {   
                $productListNb = countProductList();
                home($productListNb, 1);
            } 

            elseif ($_GET['action'] == "home" && isset($_GET['page']))
        {
        $productListNb = countproductList();

        // NEXT HOME PAGE

        if ($_GET['page'] <= 0)
            {
            header('Location: index.php?action=home');
            }

        // PREVIOUS HOME PAGE

        elseif ($_GET['page'] > $productListNb + 1)
            {
            $end = intval($_GET['page']) - 1;
            header('Location: index.php?action=home&page=' . $end);
            }
          else
            {
            home($productListNb, $_GET['page']);
            }
        }


            elseif ($_GET['action'] == 'downloadBill' && isset($_GET['orderId'])) {
                downloadBill($_GET['orderId']); 
            }

            elseif ($_GET['action'] == 'userPage') {
                userPage($_SESSION['userId']); 
            }

            elseif ($_GET['action'] == 'userOrderPage') {
                listOrdersForUser($_SESSION['userId']); 
            }

            elseif ($_GET['action'] == 'userShippingAdressPage') {
                userShippingAdressPage($_SESSION['userId']); 
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
            elseif ($_GET['action'] == 'addProductToCart')
            {
                if (isset($_POST['id']) AND isset($_POST['price']) AND isset($_POST['quantity']) ) {
    

    $data = array("id"=>(int)$_POST['id'], "title" => $_POST['title'], "quantity" => $_POST['quantity'], "price" =>$_POST['price'] );
            addProductToCart($data);

            echo 'success';
} else {
    echo 'error';
}
            }

            elseif ($_GET['action'] == 'submitOrderInfos')
            {

                if (isset($_POST['userShippingAdress']))
                {
                    $userShippingAdressId = $_POST['userShippingAdress'];
                    if (isset($_POST['billing-adress-identical'])) {

                    $billingAdressSameAs = true;
                    submitOrderInfos($userShippingAdressId, $billingAdressSameAs);

                    }
                    else {
                        $billingAdressSameAs = false;
                        $billingAdress = array('name' => $_POST['fullName'], 'adress' => $_POST['adress'], 'postalCode' => $_POST['postalCode'], 'city' => $_POST['city'], 'country' => $_POST['country']);
                        submitOrderInfos($userShippingAdressId, $billingAdressSameAs, $billingAdress);
                    }

            
                }

                else{
                    echo 'Vous nete pas connecté';
                }

    
            }



            elseif ($_GET['action'] == 'orderResult')
            {

         
                orderResult();
    
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

            elseif ($_GET['action'] == 'signOut') {
                unset($_SESSION['userId'],
        $_SESSION['login'],
        $_SESSION['admin']);
                header('Location: index.php');
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

        elseif ($_GET['action'] == 'orderAdminPage') {
            listOrdersForAdmin();
        }

         elseif ($_GET['action'] == 'statisticsAdmin') {
            statisticsAdmin();
        }

        elseif ($_GET['action'] == 'category') {
            category();
        }
        elseif ($_GET['action'] == 'addCategory' && isset($_POST['title']))
        {

        $data = array(
            'title' => $_POST['title'],
        );
        addProduct($data);
        
        }

        elseif ($_GET['action'] == 'adminPage') {
            listOrdersForAdmin();
        }

        elseif ($_GET['action'] == 'catalog') {
            catalog();
        }


        
            elseif ($_GET['action'] == 'addProduct' && isset($_POST['title']))
		{
            $productImg = $_FILES['productImg'];
            
            $productImgTmpName = $_FILES['productImg']['tmp_name'];
            $productImgName = $_FILES['productImg']['name'];

		$data = array(
			'title' => $_POST['title'],
            'category' => $_POST['category'],
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

elseif ($_GET['action'] == 'adminClients') {
    listClients();
}

        }

    
  else{
    $productListNb = countProductList();
                home($productListNb, 1);
  }

    } 

catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}


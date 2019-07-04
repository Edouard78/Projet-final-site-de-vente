<?php
require_once ('model/cart.php');
require_once ('model/cartProduct.php');

session_start();
require ('controller/controller.php');


try {
    if (isset($_GET['action']))
        {

/* GUEST/USER SECTION */

    /*---------------------------------------
        HOME PAGE
    ----------------------------------------*/

    // HOME PAGE


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

    /*---------------------------------------
        CATEGORY PAGE
    ----------------------------------------*/

        if ($_GET['action'] == 'categoryClient' && isset($_GET['description'])&&  !isset($_GET['page']))
            {   
                $productListNb = countCategoryProductList($_GET['categoryId']);
                
                categoryClient($productListNb, 1,$_GET['categoryId']);

            } 

            elseif ($_GET['action'] == 'categoryClient' && isset($_GET['categoryId']))
        {
        $productListNb = countCategoryProductList($_GET['categoryId']);


        // NEXT CATEGORY PAGE

        if ($_GET['page'] <= 0)
            {
            header('Location: index.php?action=categoryClient&categoryId='.$_GET['categoryId']);
            }

        // PREVIOUS CATEGORY PAGE

        elseif ($_GET['page'] > $productListNb + 1)
            {
            $end = intval($_GET['page']) - 1;
            header('Location: index.php?action=categoryClient&categoryId='.$_GET['categoryId'].'&page=' . $end);
            }
          else
            {
            categoryClient($productListNb, $_GET['page'], $_GET['categoryId']);
            }
        }
            

    /*---------------------------------------
        PODUIT UNIQUE PAGE
    ----------------------------------------*/

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

    /*---------------------------------------
        PANIER D'ACHAT
    ----------------------------------------*/

    // CART PAGE
            

            elseif ($_GET['action'] == 'cartPage')
            {
                cartPage();
            }
    // ADD TO CART

    elseif ($_GET['action'] == 'addProductToCart')
        {
        if (isset($_POST['id']) AND isset($_POST['price']) AND isset($_POST['quantity']) ) {
    

        $data = array("id"=>(int)$_POST['id'], "title" => $_POST['title'], "quantity" => $_POST['quantity'], "price" =>$_POST['price'] );
        addProductToCart($data);
        echo 'success'; 

        } 
        else {
            throw new Exception('Panier inxistant ou aucun identifiant d\'articles envoyés');
        }    
    
    }

    // UPDATE CART

    elseif ($_GET['action'] == 'updateProductCart')
            {


        if (isset($_SESSION['cart'])  && isset($_GET['productCartId']) && isset($_POST['quantity']) )
            {
                    
            $_SESSION['cart']->products()[$_GET['productCartId']]->updateQuantity($_POST['quantity']);

            $_SESSION['cart']->updateTotalPrice();


                cartPage();
            }

            else {

        throw new Exception('Panier inxistant ou aucun identifiant d\'articles envoyés');
            }    
    
        }

        elseif ($_GET['action'] == 'deleteProductCart')
        {
            if (isset($_SESSION['cart']) && isset($_GET['id']) && isset($_GET['id']) )
            {
                 $_SESSION['cart']->deleteProduct($_GET['id']);
                 
                 $_SESSION['cart']->updateTotalPrice();

                if (count($_SESSION['cart']->products()) == 0){
                    unset($_SESSION['cart']);
                 }

                cartPage();
            }
            else {

        throw new Exception('Panier inxistant ou aucun identifiant d\'articles envoyés');
            }    
    
        }

/*  USER LOGIN AND SUBSCRIBE   */

    /*---------------------------------------
    USER LOGIN
    ----------------------------------------*/

            elseif ($_GET['action'] == 'connexion' && isset($_POST['login']))
            {
            $login = addslashes($_POST['login']);
            $password = addslashes($_POST['password']);
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


    /*---------------------------------------
    USER SUBSCRIBE
    ----------------------------------------*/

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



 /*------------------------------------------------
    ACCES ADMIN ET UTILISATEURS / SESSIONS
    -------------------------------------------------*/       

elseif (isset($_SESSION['login']) && isset($_SESSION['admin'])){

/*---------------------------------------
    USER SECTION
    ----------------------------------------*/  

        if ($_SESSION['admin'] == FALSE){

        if ($_GET['action'] == 'downloadBill') {
            if (isset($_GET['orderId']) && $_GET['orderId'] > 0 ) {
                downloadBill($_GET['orderId']); 
            }
            else {

                throw new Exception('Aucun identifiant de facture envoyé');
            }
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

                if (isset($_SESSION['cart']) )
                {
                    $error = 0;

                    foreach ($_SESSION['cart']->products() as $product) {
                        $response = getQuantity($product->id());
                        $quantity = $response->fetch();
                        if((int) $quantity[1] < (int) $product->quantity()) {

                            $error++;
                        }
                    }

                    if($error > 0) {
                    header('Location: index.php?action=cartPage&error=1');
                }
                else {
                    $userId = $_SESSION['userId'];

                    prePaymentPage($userId);
                }
                }

                else{
                     throw new Exception('Pas de panier présent, erreur');
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
                        $billingAdressData = array('name' => $_POST['fullName'], 'adress' => $_POST['adress'], 'postalCode' => $_POST['postalCode'], 'city' => $_POST['city'], 'country' => $_POST['country']);

                        $billingAdressControl = new BillingAdress($billingAdressData);
                        $errorsFromModel = $billingAdressControl->errors();
                        if (count($errorsFromModel) > 0) {

                            echo 'erreur l\'adresse de facturation n\'est pas complète';
                        }
                        else {

                        submitOrderInfos($userShippingAdressId, $billingAdressSameAs, $billingAdressData);
                    }
                    }
                }

                else{
                    
                    throw new Exception('Erreur, informations n\'ont pas été reçu');
                }
            }

            elseif ($_GET['action'] == 'orderResult')
            {
                orderResult();
            }

            else if ($_GET['action'] == 'saveInfos' && isset($_POST['login']) && isset($_POST['email'])) {
                saveInfos($_SESSION['userId'], $_POST['login'], $_POST['email']);
            }

            else if ($_GET['action'] == 'paymentPage') {
                paymentPage();
            }

             else if ($_GET['action'] == 'deleteShippingAdress' && isset($_GET['id'])) {
                deleteShippingAdress($_GET['id']);
            }

            else if ($_GET['action'] == 'addShippingAdressPage') {
                addShippingAdressPage();
            }

            else if ($_GET['action'] == 'addShippingAdress' && isset($_POST['name'])) {
                $data = array(
            'userId' => $_SESSION['userId'],
            'title' => $_POST['title'],
            'name' => $_POST['name'],
            'adress' => $_POST['adress'],
            'postalCode' => $_POST['postalCode'],
            'city' => $_POST['city']
        );
                addShippingAdress($data);

            }
            else {
                echo 'vous navez pas les droits pour cette page';
            }
        }

        elseif ($_SESSION['admin'] == TRUE){
/*---------------------------------------
    ADMIN SECTION
    ----------------------------------------*/  

        if ($_GET['action'] == 'adminPage') {
            listOrdersForAdmin();
        }


        elseif ($_GET['action'] == 'orderAdminPage') {
            listOrdersForAdmin();
        }

        elseif ($_GET['action'] == 'adminClients') {
        listClients();
        }       

        elseif ($_GET['action'] == 'downloadBillAdmin') {
            if (isset($_GET['orderId']) && $_GET['orderId'] > 0) {
            downloadBill($_GET['orderId']); 
            }
            else {
                throw new Exception('Aucun identifiant de facture envoyé');
            }
        }

         elseif ($_GET['action'] == 'statisticsAdmin') {
            statisticsAdmin();
        }

        elseif ($_GET['action'] == 'category') {
            category();
        }
  

        elseif ($_GET['action'] == 'catalog') {
            catalog();
        }

        elseif ($_GET['action'] == 'addProduct')
        {
            if (isset($_POST['title']) && getimagesize($_FILES["productImg"]["tmp_name"]))
            {
            $productImg = $_FILES['productImg'];
            
            $productImgTmpName = $_FILES['productImg']['tmp_name'];
            $productImgName = $_FILES['productImg']['name'];

        $data = array(
            'title' => $_POST['title'],
            'categoryId' => $_POST['category'],
            'brand' => $_POST['brand'],
            'quantity' => $_POST['quantity'],
            'price' => $_POST['price'],
            'content' => $_POST['description']
        );
        addProduct($data, $productImg, $productImgTmpName, $productImgName);
        }
        else {

            header('Location: index.php?action=addProductPage&error=1');
        }
        }
        
        elseif ($_GET['action'] == 'addProductPage')
        {
        addProductPage();
        
        }

        elseif ($_GET['action'] == 'deleteProduct' && isset($_GET['id'])) {
            deleteProduct($_GET['id']);
        }

         elseif ($_GET['action'] == 'deleteUser' && isset($_GET['id'])) {
            deleteUser($_GET['id']);
        }

        elseif ($_GET['action'] == 'addCategoryPage') {
            addCategoryPage();
        }

        elseif ($_GET['action'] == 'addCategory' && isset($_POST['title']))
        {
                $data = array(
            'title' => $_POST['title'],
            'description' => $_POST['description']
        );
                addCategory($data);

        }

        elseif ($_GET['action'] == 'deleteCategory' && isset($_GET['id'])) {
            deleteCategory($_GET['id']);
        }
        else {
            echo 'vous navez pas les droit pour cette page';
        }
    }
        else{
            echo 'vous navez pas les droits pour cette page';
        }

        }
        else {
            echo 'vous devez être connecté pour accéder à cette page';
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


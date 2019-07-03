<?php
require_once('model/product.php');
require_once('model/productManager.php');
require_once('model/orderProduct.php');
require_once('model/order.php');
require_once('model/orderManager.php');
require_once('model/orderProductManager.php');
require_once('model/cart.php');
require_once('model/cartProduct.php');
require_once('model/user.php');
require_once('model/userManager.php');
require_once('model/category.php');
require_once('model/categoryManager.php');
require_once('model/billingAdress.php');
require_once('model/billingAdressManager.php');
require_once('model/bill.php');
require_once('model/userShippingAdress.php');
require_once('model/userShippingAdressManager.php');


/*  COMMUN   */

/*---------------------------------------
PANIER
----------------------------------------*/


function cartPage() {
    require('view/cartView.php');
}

function addProductToCart($data) {
    if (isset($_SESSION['cart'])) {
        $products     = $_SESSION['cart']->products();
        $newProductId = (int) $data['id'];
        foreach ($products as $key => $product) {
            $isAlreadyInCart = $product->id() == (int) $data['id'] ? TRUE : FALSE;
            if ($isAlreadyInCart == TRUE) {
                $idInArray = $key;
            }
        }
        if (isset($idInArray)) {
            $newQuantity = $products[$idInArray]->quantity() + (int) $data['quantity'];
            $_SESSION['cart']->updateProduct($idInArray, $newQuantity);
        } else {
            $cartProduct = new CartProduct($data);
            $_SESSION['cart']->addProduct($cartProduct);
            $_SESSION['cart']->updateTotalPrice();
        }
    } else {
        $cartProduct = new CartProduct($data);

        $cart        = new Cart($cartProduct);
        $cart->store($cart);
    }
}

function cartTotal() {
    $cartTotal        = new CartTotal($_SESSION['productsCart']);
    $cartTotalManager = new CartTotalManager();
    $cartTotalManager->saveTotal($cartTotal);
    var_dump($cartTotal);
    var_dump($cartTotalManager);
}

/*  USER LOGIN AND SUBSCRIBE   */


/*---------------------------------------
    CONNEXCTION
----------------------------------------*/

function authentication($login, $password) {
    include('model/db.php');
    $userManager       = new UserManager($db);
    $user              = $userManager->authenticationGet($login);
    $result            = $user->fetch();
    $isPasswordCorrect = password_verify($password, $result['password']);
    if ($login != $result['login'] || !$isPasswordCorrect) {
        header('Location: index.php?action=authenticationPage&errors=1');
        exit();
    } else {
        session_start();
        $_SESSION['userId'] = $result['id'];
        $_SESSION['login']  = $result['login'];
        $_SESSION['admin']  = $result['admin'];
        header('Location: index.php');
    }
}

function authenticationPage() {
    require('view/authenticationView.php');
}


/*---------------------------------------
    INSCRIPTION
----------------------------------------*/

function subscribe($data1, $data2) {
    include('model/db.php');
    $errors          = array();
    $newUser         = new User($data1);
    $errorsFromModel = $newUser->errors();
    if (count($errorsFromModel) > 0) {
        if (in_array(User::INVALID_LOGIN, $errorsFromModel)) {
            array_push($errors, 4);
        }
        if (in_array(User::INVALID_PASSWORD, $errorsFromModel)) {
            array_push($errors, 5);
        }
        if (in_array(User::INVALID_EMAIL, $errorsFromModel)) {
            array_push($errors, 6);
        }
    }
    $userManager    = new UserManager($db);
    $login          = $data1['login'];
    $countLogin     = $userManager->countLogin($login);
    $dataCountLogin = $countLogin->fetch();
    $email          = $data1['email'];
    $countEmail     = $userManager->countEmail($email);
    $dataCountEmail = $countEmail->fetch();
    if ($dataCountLogin['nb'] != 0) {
        array_push($errors, 1);
    }
    if ($_POST['password'] != $_POST['password2']) {
        array_push($errors, 2);
    }
    if ($dataCountEmail['nb'] != 0) {
        array_push($errors, 3);
    }
    $newUserShippingAdress = new UserShippingAdress($data2);
    $newUserShippingAdress->setTitle('Mon adresse par défault');

    $errorsFromModel = $newUserShippingAdress->errors();
    if (count($errorsFromModel) > 0) {
        if (in_array(UserShippingAdress::INVALID_TITLE, $errorsFromModel)) {
            array_push($errors, 7);
        }
        if (in_array(UserShippingAdress::INVALID_NAME, $errorsFromModel)) {
            array_push($errors, 8);
        }
        if (in_array(UserShippingAdress::INVALID_ADRESS, $errorsFromModel)) {
            array_push($errors, 9);
        }
        if (in_array(UserShippingAdress::INVALID_POSTAL_CODE, $errorsFromModel)) {
            array_push($errors, 10);
        }
        if (in_array(UserShippingAdress::INVALID_CITY, $errorsFromModel)) {
            array_push($errors, 11);
        }
    }
    if (count($errors) > 0) {
        $serialize = serialize($errors);
        $encode    = urlencode($serialize);
        header('Location: index.php?action=subscribePage&errors=' . $encode);
    } else {
        $newUser->setAdmin(0);
        $userManager = new UserManager($db);
        $userManager->createUser($newUser);
        $userId = $db->lastInsertId();
        $newUserShippingAdress->setUserId($userId);
        $userShippingAdressManager = new UserShippingAdressManager($db);
        $userShippingAdressManager->create($newUserShippingAdress);
        header('Location: index.php?action=subscribePage&success=1');
    }
}

function subscribePage() {
    require('view/subscribeView.php');
}


/*---------------------------------------
HOME AND CATEGORY PAGE
----------------------------------------*/


function countCategoryProductList($categoryId)
    {
    include ('model/db.php');

    $productManager = new ProductManager($db);
    $result = $productManager->countCategoryProduct($categoryId);
    $productNbStr = $result->fetch();
    $productNb = intval($productNbStr[0]);
    $productListNb = $productNb / 5;
    return $productListNb;
    }

function countProductList()
    {
    include ('model/db.php');

    $productManager = new ProductManager($db);
    $result = $productManager->countProduct();
    $productNbStr = $result->fetch();
    $productNb = intval($productNbStr[0]);
    $productListNb = $productNb / 5;
    return $productListNb;
    }
    function categoryClient($productListNb, $pageNumber, $categoryId) {
    include('model/db.php');
    $end = $pageNumber * 5;
    $start = ($pageNumber * 5) - 5;
    $productManager = new ProductManager($db);
    $product= $productManager->getCategoryList($start, $end, $categoryId);

    require('view/categoryClientView.php');
}

function home($productListNb, $pageNumber) {
    include('model/db.php');
    $end = $pageNumber * 5;
    $start = ($pageNumber * 5) - 5;
    $productManager = new ProductManager($db);
    $product= $productManager->getList($start, $end);
    require('view/homeView.php');
}


/*---------------------------------------
PRODUIT UNIQUE PAGE
----------------------------------------*/

function productUnique($id) {
    include('model/db.php');
    $productManager = new ProductManager($db);
    $product        = $productManager->getUnique($id);
    require('view/productUniqueView.php');
}


/*  UTILISATEUR   */


function orderUnique($id) {
    include('model/db.php');

    $orderManager = new OrderManager($db);
    $orderResponse = $orderManager->getUnique($orderId);
    $dataOrder = $orderResponse->fetch();
}
function downloadBill($orderId) {
    include('model/db.php');

if ($_SESSION['admin'] == TRUE) {

    $orderManager = new OrderManager($db);
    $orderResponse = $orderManager->getUnique($orderId);
}
else if ($_SESSION['admin'] == FALSE) {
    $orderManager = new OrderManager($db);
    $orderResponse = $orderManager->getUniqueForUser($orderId, $_SESSION['userId'] );
} 
else {
    throw new Exception('Vous n\'avez pas les droits pour accéder à cette facture');
}

  $dataOrder = $orderResponse->fetch();
    $order = new Order($dataOrder);

    $orderProductManager = new OrderProductManager($db);
    $orderProductResponse = $orderProductManager->getListFromOrder($orderId);
    $dataOrderProduct = $orderProductResponse->fetchAll();

    $orderProducts = [];
    foreach ($dataOrderProduct as $data) {
        $orderProduct = new OrderProduct($data);
        array_push($orderProducts, $orderProduct);
    }
    $order->setProducts($orderProducts);

    $userShippingAdressManager = new userShippingAdressManager($db);
    $userShippingAdressResponse = $userShippingAdressManager->getUnique($order->userId());
    $dataShippingAdress = $userShippingAdressResponse->fetch();

    $userShippingAdress = new UserShippingAdress($dataShippingAdress);
    if($order->billingAdressSameAs() == TRUE) {
        $billingAdress = new BillingAdress($dataShippingAdress);
    }
    else {
        $billingAdressManager = new BillingAdressManager($db);
        $response = $billingAdressManager->getUnique($orderId);
        $responseFetch = $response->fetch();
        $data = array('name' => $responseFetch[0], 'adress' => $responseFetch[1], 'postalCode' => $responseFetch[2], 'city' => $responseFetch[3], 'country' => $responseFetch[4] );
        $billingAdress = new BillingAdress($data);
    }

    $data = array('order' => $order, 'userShippingAdress' => $userShippingAdress, 'billingAdress' => $billingAdress, 'paymentMethod' => 'Stripe');

    $bill = new Bill($data);
    $bill->setContent();
    $bill->generatePdf();

}
function listOrdersForUser($userId) {
    include('model/db.php');
    $orderManager = new OrderManager($db);
    $dataOrder = $orderManager->getListFromUser($userId);

    $orderProductManager = new OrderProductManager($db);
    $nbProducts =  $orderProductManager->getListFromUser($userId);

    require('view/user/userOrdersView.php');

}

function userPage($userId) {
    include('model/db.php');
    $userManager = new userManager($db);
    $userInfos = $userManager->getInfos($userId);


    require('view/user/userInfos.php');

}

function deleteShippingAdress($id) {
    include('model/db.php');
    $userShippingAdressManager = new UserShippingAdressManager($db);
    $userShippingAdressManager->delete($id);

    header('Location: index.php?action=addShippingAdressPage');
}

function addShippingAdressPage() {
    require('view/user/addShippingAdressView.php');
}

function addShippingAdress($data) {

    include('model/db.php');

    $userShippingAdress = new UserShippingAdress($data);

    $errorsFromModel = $userShippingAdress->errors();
    if (count($errorsFromModel) > 0) {


    header('Location: index.php?action=addShippingAdressPage&error=1');

}
else {
    $userShippingAdressManager = new UserShippingAdressManager($db);
    $userShippingAdressManager->create($userShippingAdress);

    header('Location: index.php?action=userShippingAdressPage');
}
        
    
}

function saveInfos($userId, $login, $email) {
    include('model/db.php');

    $data = array('id' => $userId, 'login' => $login, 'email' => $email);
    $user = new User($data);
    $userManager = new userManager($db);
    $userManager->saveInfos($user);


    header('Location: index.php?action=userPage');
}

function userShippingAdressPage($userId) {
    include('model/db.php');
    $userShippingAdressManager = new userShippingAdressManager($db);
    $userShippingAdress = $userShippingAdressManager->getList($userId);


    require('view/user/userShippingAdressView.php');

}

function orderResult() {
    require('view/orderResult.php');
}
function saveOrder($order, $orderProducts,$token, $billingAdress = NULL) {
    include('model/db.php');
    $orderManager = new OrderManager($db);
    $orderManager->create($order, $token);


    $orderIdReq = $orderManager->getUserOrderId($token);
    $orderId = $orderIdReq->fetch();

    $orderId = (int) $orderId['id'];

    $orderProductManager = new OrderProductManager($db);
    foreach ($orderProducts as $orderProduct) {
        $orderProductManager->create($orderProduct, $orderId);
        var_dump($orderProductManager);
            }
    if ($billingAdress != NULL) {
        $billingAdressManager = new BillingAdressManager($db);
        $billingAdressManager->create($billingAdress, $orderId);
    }

    header('Location: index.php?action=orderResult&success=1');
    unset($_SESSION['cart']);
    unset($_SESSION['userShippingAndBillingInfos']);

    require('view/prePaymentView.php');
}

function updateQuantity($orderProducts){
    include('model/db.php');

    $productManager = new ProductManager($db);
    var_dump($orderProducts);
    for ($i = 0; $i < count($orderProducts) ; $i++) {
        $productManager->updateQuantity($orderProducts[$i]); 
    } 
}

function prePaymentPage($userId) {
    include('model/db.php');

    $userShippingAdressManager = new UserShippingAdressManager($db);
    $userShippingAdress        = $userShippingAdressManager->getList($userId);

    require('view/prePaymentView.php');
}

function submitOrderInfos($userShippingAdressId, $billingAdressSameAs, $billingAdress = NULL) {

    $_SESSION['userShippingAndBillingInfos'] = array(
        'userShippingAdressId' => $userShippingAdressId,
        'billingAdressSameAs' => $billingAdressSameAs,
        'billingAdress' => $billingAdress
    );

    require('view/paymentView.php');
}

function paymentPage() {

    require('view/paymentView.php');
}

/*  ADMIN   */

function addCategory() {
    include('model/db.php');
    $category= new Category($data);
    $errorsFromModel = $category->errors();
    if (count($errorsFromModel) > 0) {
        if (in_array(Category::INVALID_TITLE, $errorsFromModel) ) {
            echo 'erreurrr';
        }
    }
    else {
        $categoryManager = new CategoryManager($db);
        $categoryManager->create($category);
        require('view/admin/categoryView.php');
    }
}

function category() {
    include('model/db.php');
    $categoryManager = new CategoryManager($db);
    $categories = $categoryManager->getList();


    require('view/admin/categoryView.php');

}
function addproductPage() {
    include('model/db.php');

    $categoryManager = new CategoryManager($db);
    $categories = $categoryManager->getList();

    require('view/admin/addProductView.php');
}
function addProduct($data, $productImg, $productImgTmpName, $productImgName) {
    include('model/db.php');
    $product         = new Product($data);
    $errorsFromModel = $product->errors();

    if (count($errorsFromModel) > 0) {
        if (in_array(Product::INVALID_TITLE, $errorsFromModel) OR in_array(Product::INVALID_BRAND, $errorsFromModel) OR in_array(Product::INVALID_CONTENT, $errorsFromModel)) {
            header('Location: index.php?action=addProductPage&error=1');
        }
    } else {
        $productManager = new ProductManager($db);
        $productManager->addProduct($product);
        $productId             = $db->lastInsertId();
        $imgExt                = explode('.', $productImg['name']);
        $imgActualExt          = strtolower(end($imgExt));
        $productImgDestination = './uploads/products/' . $productId . '.' . $imgActualExt;
        move_uploaded_file($productImg['tmp_name'], $productImgDestination);

        header('Location: index.php?action=catalog');

    }
}

    function listOrdersForAdmin() {
        include('model/db.php');

        $orderManager = new OrderManager($db);
        $orders = $orderManager->getListForAdmin();

        require('view/admin/orderView.php');
    }

    function catalog() {
        include('model/db.php');

        $productManager = new ProductManager($db);
        $products = $productManager->getListForAdmin();

        $categoryManager = new CategoryManager($db);
        $categories = $categoryManager->getList();

        require('view/admin/catalogView.php');
    }

    function statisticsAdmin() {
        include('model/db.php');
        $orderManager = new OrderManager($db);
        $countOrders = $orderManager->countTodayOrders();
        $countOrders = $countOrders->fetch();

        $userManager = new UserManager($db);

        $countUsers = $userManager->countTodayUsers();
        $countUsers = $countUsers->fetch();

        $orderManager = new OrderManager($db);

        $count = [];
        for( $i = 0; $i<7; $i++ ) {
            $countDay = $orderManager->countDay($i);
        
            $countDayData = $countDay->fetch();
            array_unshift($count, (int)$countDayData[0]);
        }

        if ( $countOrders[0] == 0 ) {
            $dayIncome = 0;
        }

        else {
            $orderManager = new OrderManager($db);
            $totayTotal = $orderManager->getTodayTotal();
            $total = 0;
            while( $data = $totayTotal->fetch()) {
                $total += (int) $total;
            }

            $dayIncome = $total;
        }
        require('view/admin/statisticsView.php');
    }


    function listClients() {
        include('model/db.php');

        $userManager = new UserManager($db);
    $users = $userManager->getList();
    require ('view/admin/userView.php');
    }
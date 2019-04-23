<?php

require_once ('/../model/product.php');

require_once ('/../model/productManager.php');


require_once ('/../model/orderProduct.php');

require_once ('/../model/order.php');

require_once ('/../model/cart.php');

require_once ('/../model/cartProduct.php');


require_once ('/../model/user.php');

require_once ('/../model/userManager.php');

require_once ('/../model/userShippingAdress.php');

require_once ('/../model/userShippingAdressManager.php');

function prePaymentPage($userId)
{
	include ('/../model/db.php');

	$userShippingAdressManager = new UserShippingAdressManager($db);
	$userShippingAdress = $userShippingAdressManager->getList($userId);

	
	require ('/../view/prePaymentView.php');
}

function validateOrder($userShippingAdressId, $userBillingAdress, $cart)
{
	include ('/../model/db.php');

	$order = new Order();
	$orderProducts = [];

	$cartProducts = $cart->products();

	foreach($cartProducts as $cartProduct)
	{
		$cartProductData = get_object_vars($cartProduct);
	
		$orderProduct = new OrderProduct($cartProductData);

		var_dump($orderProduct);

		

	}
	
}

function cartPage()
{
	require ('/../view/cartView.php');
}

function addProductToCart($data)
	{
		if (isset($_SESSION['cart']))
		{
			
			$products = $_SESSION['cart']->products();
			$newProductId = (int) $data['id'];
	
		
			foreach($products as $key => $product )
			{
				$isAlreadyInCart = $product->id() == (int) $data['id']? TRUE : FALSE;
				
				if ($isAlreadyInCart == TRUE)
				{
					$idInArray = $key;
				}
			}
			var_dump($idInArray);
	
			if(isset($idInArray))
			{
					$newQuantity = $products[$idInArray]->quantity() + (int)$data['quantity'];
					$_SESSION['cart']->updateProduct($idInArray, $newQuantity);
				}
				else {
					
			$cartProduct = new CartProduct($data);
			$_SESSION['cart']->addProduct($cartProduct);
			$_SESSION['cart']->updateTotalPrice();
				}
			}

		else{
		$cartProduct = new CartProduct($data);
		$cart = new Cart($cartProduct);
		$cart->store($cart);
		}

	}

	
function cartTotal()
{


	$cartTotal = new CartTotal($_SESSION['productsCart']);

		$cartTotalManager = new CartTotalManager();
		$cartTotalManager->saveTotal($cartTotal);

		var_dump($cartTotal);
		var_dump($cartTotalManager);
	

}

function authentication($login, $password)
	{
	include ('/../model/db.php');

	$userManager = new UserManager($db);
	$user = $userManager->authenticationGet($login);

	$result = $user->fetch();
	$isPasswordCorrect = password_verify($password, $result['password']);
	if ($login != $result['login'] || !$isPasswordCorrect)
		{
		header('Location: index.php?action=authenticationPage&errors=1');
		exit();
		}
	  else
		{
		session_start();
		$_SESSION['userId'] = $result['id'];
		$_SESSION['login'] = $result['login'];
		$_SESSION['admin'] = $result['admin'];
		header('Location: index.php');
		}
	}

function authenticationPage()
	{
	require ('/../view/authenticationView.php');

	}

	function subscribe($data1, $data2)
	{
		include ('/../model/db.php');

	$errors = array();

	$newUser = new User($data1);
	$errorsFromModel = $newUser->errors();
	if (count($errorsFromModel) > 0)
		{
		if (in_array(User::INVALID_LOGIN, $errorsFromModel))
			{
			array_push($errors, 4);
			}

		if (in_array(User::INVALID_PASSWORD, $errorsFromModel))
			{
			array_push($errors, 5);
			}

		if (in_array(User::INVALID_EMAIL, $errorsFromModel))
			{
			array_push($errors, 6);
			}
		}


	$userManager = new UserManager($db);
	$login = $data1['login'];
	$countLogin = $userManager->countLogin($login);
	$dataCountLogin = $countLogin->fetch();
	$email = $data1['email'];
	$countEmail = $userManager->countEmail($email);
	$dataCountEmail = $countEmail->fetch();

		if ($dataCountLogin['nb'] != 0)
			{
			array_push($errors, 1);
			}
	
		if ($_POST['password'] != $_POST['password2'])
			{
			array_push($errors, 2);
			}
	
		if ($dataCountEmail['nb'] != 0)
			{
			array_push($errors, 3);
			}


			$newUserShippingAdress = new UserShippingAdress($data2);
			$newUserShippingAdress->setTitle('Mon adresse par défault');
			var_dump($newUserShippingAdress);
			$errorsFromModel = $newUserShippingAdress->errors();
			if (count($errorsFromModel) > 0)
				{
				if (in_array(UserShippingAdress::INVALID_TITLE, $errorsFromModel))
					{
					array_push($errors, 7);
					}
				if (in_array(UserShippingAdress::INVALID_NAME, $errorsFromModel))
					{
					array_push($errors, 8);
					}
		
				if (in_array(UserShippingAdress::INVALID_ADRESS, $errorsFromModel))
					{
					array_push($errors, 9);
					}
		
				if (in_array(UserShippingAdress::INVALID_POSTAL_CODE, $errorsFromModel))
					{
					array_push($errors, 10);
					}

					if (in_array(UserShippingAdress::INVALID_CITY, $errorsFromModel))
					{
					array_push($errors, 11);
					}	
				}
				

	if (count($errors) > 0)
		{
		$serialize = serialize($errors);
		$encode = urlencode($serialize);
		header('Location: index.php?action=subscribePage&errors=' . $encode);
		}
	  else
		{
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

function subscribePage()
	{
	require ('/../view/subscribeView.php');

	}


function home()
	{
		include ('/../model/db.php');
		
		$productManager = new ProductManager($db);
	$product = $productManager->getList();

	require ('/../view/homeView.php');

	}

	function productUnique($id)
	{
	include ('model/db.php');

	$productManager = new ProductManager($db);
	$product = $productManager->getUnique($id);

	require ('/../view/productUniqueView.php');

	}

	function addproductPage()
	{
    include ('/../model/db.php');
    
	require ('/../view/admin/addProductView.php');

	}


	function addProduct($data, $productImg, $productImgTmpName, $productImgName)
	{
	include ('/../model/db.php');

	$product = new Product($data);
	$errorsFromModel = $product->errors();
	if (count($errorsFromModel) > 0)
		{
		if (in_array(Product::INVALID_TITLE, $errorsFromModel) OR in_array(Product::INVALID_BRAND, $errorsFromModel) OR in_array(Product::INVALID_CONTENT, $errorsFromModel))
			{
			echo 'erreurrr';
			}
		}
	  else
		{

		$productManager = new ProductManager($db);
		$productManager->addproduct($product);
		$productId = $db->lastInsertId();


		$imgExt = explode('.', $productImg['name']);
		$imgActualExt = strtolower(end($imgExt));
		$productImgDestination = './uploads/products/'.$productId.'.'.$imgActualExt;

		move_uploaded_file($productImg['tmp_name'], $productImgDestination);

		var_dump($product);
		}
	}

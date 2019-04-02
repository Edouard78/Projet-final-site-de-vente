<?php

require_once ('/../model/item.php');

require_once ('/../model/itemManager.php');


require_once ('/../model/checkout.php');

require_once ('/../model/checkoutTotalManager.php');


require_once ('/../model/user.php');

require_once ('/../model/userManager.php');

require_once ('/../model/userShippingAdress.php');

require_once ('/../model/userShippingAdressManager.php');

function checkoutPage()
{
	require ('/../view/checkoutView.php');
}

function checkoutAdd($data)
	{
		
		$checkoutItem = new CheckoutItem($data);
		$checkout = new Checkout();
		$checkout->addItem($checkoutItem);


		checkoutTotal();


	}

	
function checkoutTotal()
{


	$checkoutTotal = new CheckoutTotal($_SESSION['itemsCheckout']);

		$checkoutTotalManager = new CheckoutTotalManager();
		$checkoutTotalManager->saveTotal($checkoutTotal);

		var_dump($checkoutTotal);
		var_dump($checkoutTotalManager);
	

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
			$errorsFromModel = $newUserShippingAdress->errors();
			if (count($errorsFromModel) > 0)
				{
				if (in_array(UserShippingAdress::INVALID_NAME, $errorsFromModel))
					{
					array_push($errors, 7);
					}
		
				if (in_array(UserShippingAdress::INVALID_ADRESS, $errorsFromModel))
					{
					array_push($errors, 8);
					}
		
				if (in_array(UserShippingAdress::INVALID_POSTAL_CODE, $errorsFromModel))
					{
					array_push($errors, 9);
					}

					if (in_array(UserShippingAdress::INVALID_CITY, $errorsFromModel))
					{
					array_push($errors, 10);
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
		
		$itemManager = new ItemManager($db);
	$item = $itemManager->getList();

	require ('/../view/homeView.php');

	}

	function itemUnique($id)
	{
	include ('model/db.php');

	$itemManager = new ItemManager($db);
	$item = $itemManager->getUnique($id);

	require ('/../view/itemUniqueView.php');

	}

	function addItemPage()
	{
    include ('/../model/db.php');
    
	require ('/../view/admin/addItemView.php');

	}


	function addItem($data, $itemImg, $itemImgTmpName, $itemImgName)
	{
	include ('/../model/db.php');

	$item = new Item($data);
	$errorsFromModel = $item->errors();
	if (count($errorsFromModel) > 0)
		{
		if (in_array(Item::INVALID_TITLE, $errorsFromModel) OR in_array(Item::INVALID_BRAND, $errorsFromModel) OR in_array(Item::INVALID_CONTENT, $errorsFromModel))
			{
			echo 'erreurrr';
			}
		}
	  else
		{

		$itemManager = new ItemManager($db);
		$itemManager->addItem($item);
		$itemId = $db->lastInsertId();


		$imgExt = explode('.', $itemImg['name']);
		$imgActualExt = strtolower(end($imgExt));
		$itemImgDestination = './uploads/items/'.$itemId.'.'.$imgActualExt;

		move_uploaded_file($itemImg['tmp_name'], $itemImgDestination);

		var_dump($item);
		}
	}

<?php
require_once ('/../model/item.php');
require_once ('/../model/itemManager.php');

require_once ('/../model/user.php');

require_once ('/../model/userManager.php');

require_once ('/../model/userShippingAdress.php');


function home()
	{
		include ('/../model/db.php');
		
		$itemManager = new ItemManager($db);
	$item = $itemManager->getList();

	require ('/../view/homeView.php');

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

<?php

require ('controller/controller.php');


try {
    if (isset($_GET['action']))
        {
            if ($_GET['action'] == 'home')
            {
                home();
            } 
            if ($_GET['action'] == 'addItem' && isset($_POST['title']))
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
        
        if ($_GET['action'] == 'addItemPage')
		{
		addItemPage();
		
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

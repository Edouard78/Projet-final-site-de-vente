<?php

class OrderProductManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function create(OrderProduct $orderProduct, $orderId)
	{
		$req = $this->_db->prepare('INSERT INTO shoporderproduct(productId, orderId, userId, title, quantity, price, date) VALUES(:productId,:orderId, :userId, :title, :quantity, :price, NOW() )');
    	$req->bindValue(':productId', $orderProduct->id());
    	$req->bindValue(':orderId', $orderId);
    	$req->bindValue(':userId', $orderProduct->userId());
    	$req->bindValue(':title', $orderProduct->title());
		$req->bindValue(':quantity', $orderProduct->quantity());
		$req->bindValue(':price', $orderProduct->price());
    	$req->execute();
	}


	public function getList(){

		$request = $this->_db ->prepare('SELECT id, title, brand, content,price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM product ');
	    $request->execute();
		return $request;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, title, brand, content, price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM product WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}

	public function getListFromOrder($orderId){

		$request = $this->_db ->prepare('SELECT id, productId, orderId, title, quantity, price, date FROM shoporderproduct WHERE orderId = :orderId ');
		$request->bindValue(':orderId', $orderId);
	    $request->execute();
		return $request;
	}

	public function getListFromUser($userId){

		$request = $this->_db ->prepare('SELECT id, orderId FROM shoporderproduct WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}

	public function countOrderProduct($orderId){

		$request = $this->_db ->prepare('SELECT COUNT(*) FROM shoporderProduct WHERE orderId = :orderId ');
		$request->bindValue(':orderId', $orderId);
	    $request->execute();
		return $request;
	}
}

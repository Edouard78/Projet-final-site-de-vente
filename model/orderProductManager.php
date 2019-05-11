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
		$req = $this->_db->prepare('INSERT INTO shoporderproduct(productId, orderId, quantity, price, date) VALUES(:productId,:orderId, :quantity, :price, NOW() )');
    	$req->bindValue(':productId', $orderProduct->id());
    	$req->bindValue(':orderId', $orderId);
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
}

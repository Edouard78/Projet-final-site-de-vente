<?php

class OrderManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(Order $order, $token)
	{
		$req = $this->_db->prepare('INSERT INTO shoporder(userId, userShippingAdressId, billingAdressSameAs, token, totalPrice, date) VALUES(:userId, :userShippingAdressId,:billingAdressSameAs, :token, :totalPrice, NOW()  )');
	
		
	$req->bindValue(':userId', $order->userId());
    $req->bindValue(':userShippingAdressId', $order->userShippingAdressId());
    $req->bindValue(':billingAdressSameAs', $order->billingAdressSameAs());
    $req->bindValue(':token', $token);
	$req->bindValue(':totalPrice', $order->totalPrice());
    $req->execute();
	}

	public function getUserOrderId($token){

		$request = $this->_db ->prepare('SELECT id FROM shoporder WHERE token = :token ');
		$request->bindValue(':token', $token);
	    $request->execute();
		return $request;
	}

	public function getListFromUser($userId){

		$request = $this->_db ->prepare('SELECT id, userId, userShippingAdressId, billingAdressSameAs,token,totalPrice, DATE_FORMAT(date, \'%d/%m/%Y\') AS dateFr FROM shoporder WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, userId, userShippingAdressId, billingAdressSameAs,token,totalPrice, DATE_FORMAT(date, \'%d/%m/%Y\') AS date FROM shoporder WHERE id = :id ');
		$request->bindValue(':id', $id);
	    $request->execute();
		return $request;
	}



	
}
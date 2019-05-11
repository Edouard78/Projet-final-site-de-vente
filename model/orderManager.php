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


	
}
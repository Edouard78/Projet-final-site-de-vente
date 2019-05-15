<?php

class BillManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(Bill $bill, $token)
	{
		$req = $this->_db->prepare('INSERT INTO bill(orderId, userId) VALUES(:orderId, :userId )');
	
	$req->bindValue(':orderId', $bill->orderId());
	$req->bindValue(':userId', $bill->userId());
    $req->execute();
	}

	public function getUserOrderId($token){

		$request = $this->_db ->prepare('SELECT id FROM shoporder WHERE token = :token ');
		$request->bindValue(':token', $token);
	    $request->execute();
		return $request;
	}


	
}
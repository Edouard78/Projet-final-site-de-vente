<?php

class BillingAdressManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(BillingAdress $billingAdress, $orderId)
	{
		$req = $this->_db->prepare('INSERT INTO billingadress(orderId, name, adress, postalCode, city, country) VALUES(:orderId, :name,:adress, :postalCode, :city, :country )');
	
		
    $req->bindValue(':orderId', $orderId);
    $req->bindValue(':name', $billingAdress->name());
	$req->bindValue(':adress', $billingAdress->adress());
    $req->bindValue(':postalCode', $billingAdress->postalCode());
	$req->bindValue(':city', $billingAdress->city());
	$req->bindValue(':country', $billingAdress->country());
    $req->execute();
	}

	public function getList($userId){

		$request = $this->_db ->prepare('SELECT id, title FROM shippingadress WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}

	public function getUnique($orderId){

		$request = $this->_db ->prepare('SELECT name, adress, postalCode, city, country FROM billingadress WHERE orderId = :orderId');
		$request->bindValue(':orderId', (int)$orderId);
	    $request->execute();
		return $request;
	}

	public function delete($id)
	{
		$id = (int) $id;
    $req = $this->_db->prepare('DELETE FROM shippingAdress WHERE id = :id');
    $req->bindValue(':id', $id );
    $req->execute();
	}


	
}
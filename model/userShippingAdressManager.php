<?php

class UserShippingAdressManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(UserShippingAdress $userShippingAdress)
	{
		$req = $this->_db->prepare('INSERT INTO shippingadress(title, userId, name, adress, postalCode, city) VALUES(:title, :userId, :name,:adress, :postalCode, :city )');
	
		
	$req->bindValue(':title', $userShippingAdress->title());
    $req->bindValue(':userId', $userShippingAdress->userId());
    $req->bindValue(':name', $userShippingAdress->name());
	$req->bindValue(':adress', $userShippingAdress->adress());
    $req->bindValue(':postalCode', $userShippingAdress->postalCode());
	$req->bindValue(':city', $userShippingAdress->city());
    $req->execute();
	}

	public function getList($userId){

		$request = $this->_db ->prepare('SELECT id, title FROM shippingadress WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}

	public function getUnique($userId){

		$request = $this->_db ->prepare('SELECT id, name, adress, postalCode, city FROM shippingadress WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}


	
}
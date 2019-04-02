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
		$req = $this->_db->prepare('INSERT INTO shippingadress(userId, name, adress, postalCode, city) VALUES(:userId, :name,:adress, :postalCode, city )');

    $req->bindValue(':userId', $userShippingAdress->userId());
    $req->bindValue(':name', $userShippingAdress->name());
	$req->bindValue(':adress', $userShippingAdress->adress());
    $req->bindValue(':postalCode', $userShippingAdress->postalCode());
    
	$req->bindValue(':city', $userShippingAdress->city());
    $req->execute();
	}


	
}
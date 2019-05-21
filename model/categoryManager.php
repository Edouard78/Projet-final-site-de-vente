<?php

class CategoryManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(Category $userShippingAdress)
	{
		$req = $this->_db->prepare('INSERT INTO category(title) VALUES(:title )');
	
		
	$req->bindValue(':title', $userShippingAdress->title());
    $req->execute();
	}

	public function getList(){

		$request = $this->_db ->prepare('SELECT id, title FROM category');
	    $request->execute();
		return $request;
	}

	public function getUnique($userId){

		$request = $this->_db ->prepare('SELECT id, name, adress, postalCode, city FROM shippingadress WHERE userId = :userId ');
		$request->bindValue(':userId', $userId);
	    $request->execute();
		return $request;
	}

		public function delete($id)
	{
		
	  $req = $this->_db->prepare('DELETE FROM category WHERE id = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();

	}


	
}
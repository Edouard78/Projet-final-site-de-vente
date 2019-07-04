<?php

class CategoryManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

    public function create(Category $category)
	{
		$req = $this->_db->prepare('INSERT INTO category(title, description, date) VALUES(:title, :description, NOW() )');
	
		
	$req->bindValue(':title', $category->title());
	$req->bindValue(':description', $category->description());
    $req->execute();
	}

	public function getList(){

		$request = $this->_db ->prepare('SELECT id, title, description, date FROM category');
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
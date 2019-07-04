<?php

class ProductManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function addProduct(Product $product)
	{
		$req = $this->_db->prepare('INSERT INTO product(categoryId, title, brand, quantity, content, price, addingDate, updatingDate) VALUES(:categoryId, :title, :brand, :quantity, :content, :price, NOW(), NOW() )');
		$req->bindValue(':categoryId', $product->categoryId());
    	$req->bindValue(':title', $product->title());
    	$req->bindValue(':brand', $product->brand());
		$req->bindValue(':content', $product->content());
		$req->bindValue(':quantity', $product->quantity());
		$req->bindValue(':price', $product->price());
    	$req->execute();
	}


	public function getList($start , $end){

		$request = $this->_db ->prepare('SELECT id, title, brand, content,price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM product ORDER BY addingDateFr ASC LIMIT :start ,:end ');
		$request->bindValue(':start', $start, PDO::PARAM_INT);
		$request->bindValue(':end', $end, PDO::PARAM_INT);
	    $request->execute();
		return $request;
	}

	public function getCategoryList($start,$end, $id){

		$request = $this->_db ->prepare('SELECT id, title, brand, content,price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr FROM product WHERE categoryId = :categoryId ORDER BY addingDateFr ASC LIMIT :start , :end');

		$request->bindValue(':start', $start, PDO::PARAM_INT);
		$request->bindValue(':end', $end, PDO::PARAM_INT);

		$request->bindValue(':categoryId', $id);
		$request->execute();
	
		return $request;
	}


	public function getListForAdmin(){

		$request = $this->_db ->prepare('SELECT id, title, brand, content,price, quantity, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM product ORDER BY addingDateFr ASC ');
	    $request->execute();
		return $request;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, title, brand, content, price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM product WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}

	public function getQuantity($id)
	{
		$request = $this->_db->prepare('SELECT id, quantity FROM product WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}


	public function countProduct()
	{
		$req = $this->_db->prepare('SELECT COUNT(id) AS productNb FROM product');
		$req->execute();
		return $req;
	}

	public function countCategoryProduct($id)
	{
		$req = $this->_db->prepare('SELECT COUNT(id) AS productNb FROM product WHERE categoryId = ?');
		$req->execute(array($id));
		return $req;
	}

	public function updateQuantity(OrderProduct $orderProduct)
	{
		$request = $this->_db->prepare('UPDATE product SET quantity = quantity - :quantity WHERE id = :id');

    $request->bindValue(':quantity', $orderProduct->quantity());
    $request->bindValue(':id', $orderProduct->id());

    $request->execute();
}

public function delete($id)
	{
		
	  $req = $this->_db->prepare('DELETE FROM product WHERE id = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();

	}

	public function deleteFromCategory($id)
	{
		
	  $req = $this->_db->prepare('DELETE FROM product WHERE categoryId = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();

	}
}

<?php

class ItemManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function addItem(Item $item)
	{
		$req = $this->_db->prepare('INSERT INTO item(title, brand, content, price, addingDate, updatingDate) VALUES(:title,:brand, :content, NOW(), NOW() )');

    $req->bindValue(':title', $item->title());
    $req->bindValue(':brand', $item->brand());
	$req->bindValue(':content', $item->content());
	$req->bindValue(':price', $item->price());
    $req->execute();
	}


	public function getList(){

		$request = $this->_db ->prepare('SELECT id, title, brand, content,price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM item ');
	    $request->execute();
		return $request;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, title, brand, content, price, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM item WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}





}

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
		$req = $this->_db->prepare('INSERT INTO item(title, brand, content, addingDate, updatingDate) VALUES(:title,:brand, :content, NOW(), NOW() )');

    $req->bindValue(':title', $item->title());
    $req->bindValue(':brand', $item->brand());
	$req->bindValue(':content', $item->content());
    $req->execute();
	}


	public function getList(){

		$request = $this->_db ->prepare('SELECT id, title, brand, content, DATE_FORMAT(addingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addingDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM item ');
	    $request->execute();
		return $request;
	}




}

<?php

class User
{
	protected $_id,
	          $_userId,
	          $_name,
	          $_email,
			  $_errors=[];

	CONST INVALID_NAME = 1;

	  public function __construct($data)
	{
		$this->hydrate($data);
	}

  public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);

		  if (method_exists($this, $method))
		  {
			  $this->$method($value);
		  }
		}	
	}



	//GETTERS

	public function id()
	{
		return $this->_id;
	}

	public function userId()
	{
		return $this->_userId;
	}

	public function name()
	{
		return $this->_name;
	}

	public function errors()
	{
		return $this->_errors;
	}

	//SETTERS

	public function setId($id)
	{
		$id = (int)$id;
		$this->_id = $id;
	}

	public function setId($userId)
	{
		$userId = (int)$userId;
		$this->_userId = $userId;
	}

	public function setName($name)
	{
		if (!is_string($name) || empty($name))
		{
			$this->_errors[]=self::INVALID_NAME;
		}
		else
		{
			$this->_name = $name;
		}
	}


}
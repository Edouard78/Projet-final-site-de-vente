<?php

class Item
{
	protected $_id,
			  $_name,
			  $_brand,
			  $_description,
			  $_addingDate,
			  $_updatingDate,
			  $_errors=[];

	const INVALID_NAME = 1;
	const INVALID_BRAND = 2;
	const INVALID_DESCRIPTION = 3;

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

	public function name()
	{
		return $this->_name;
	}

	public function brand()
	{
		return $this->_brand;
	}

	public function description()
	{
		return $this->_description;
	}

	public function addingDate()
	{
		return $this->_addingDate;
	}

		public function updatingDate()
	{
		return $this->_updatingDate;
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

	public function setBrand($brand)
	{
		if (!is_string($brand) || empty($brand))
		{
			$this->_errors[]=self::INVALID_BRAND;
		}
		else
		{
			$this->_brand = $brand;
		}
	}

	public function setDescription($description)
	{
		if (!is_string($description) || empty($description))
		{
			$this->_errors[]=self::INVALID_DESCRIPTION;
		}
		else
		{
			$this->_content = $content;
		}
	}

	public function setAddingDate($addingDate)
	{
		$this->_addingDate = $addingDate;
	}

	public function setUpdatingDate($updatingDate)
	{
		$this->_updatingDate = $updatingDate;
	}

}

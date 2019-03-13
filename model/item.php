<?php

class Item
{
	protected $_id,
			  $_title,
			  $_brand,
			  $_content,
			  $_addingDate,
			  $_updatingDate,
			  $_errors=[];

	const INVALID_TITLE = 1;
	const INVALID_BRAND = 2;
	const INVALID_CONTENT = 3;

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

	public function title()
	{
		return $this->_title;
	}

	public function brand()
	{
		return $this->_brand;
	}

	public function content()
	{
		return $this->_content;
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

	public function setTitle($title)
	{
		if (!is_string($title) || empty($title))
		{
			$this->_errors[]=self::INVALID_TITLE;
		}
		else
		{
			$this->_title = $title;
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

	public function setContent($content)
	{
		if (!is_string($content) || empty($content))
		{
			$this->_errors[]=self::INVALID_CONTENT;
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

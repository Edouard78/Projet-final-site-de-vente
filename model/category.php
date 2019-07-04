<?php

class Category
{
	protected $_id,
			  $_title,
			  $_description,
			  $_date,
			  $_errors=[];

	const INVALID_TITLE = 1;
	const INVALID_DESCRIPTION = 1;

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


	public function description()
	{
		return $this->_description;
	}


	public function date()
	{
		return $this->_date;
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

	public function setDescription($description)
	{
		if (!is_string($description) || empty($description))
		{
			$this->_errors[]=self::INVALID_DESCRIPTION;
		}
		else
		{
			$this->_description = $description;
		}
	}


	public function setDate($date)
	{
		$this->_date = $date;
	}

}

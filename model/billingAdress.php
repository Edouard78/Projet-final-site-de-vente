<?php

class BillingAdress
{
    protected $_id;
	protected $_orderId;
	protected $_name;
    protected $_adress;
    protected $_postalCode;
	protected $_city;
	protected $_country;
	protected $_errors = [];


	CONST INVALID_NAME = 1;
	CONST INVALID_ADRESS = 2;
    CONST INVALID_POSTAL_CODE = 3;
    CONST INVALID_CITY = 4;
    CONST INVALID_COUNTRY = 5;


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

    // GETTERS
    public function id()
    {
        return $this->_id;
	}

    public function orderId()
    {
        return $this->_orderId;
    }

public function name()
    {
        return $this->_name;
    }

    
public function adress()
{
    return $this->_adress;
}

public function postalCode()
{
    return $this->_postalCode;
}

public function city()
{
    return $this->_city;
}

public function country()
{
    return $this->_country;
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
	

    public function setOrderId($orderId)
    {
        $orderId = (int)$orderId;
        $this->_orderId = $orderId;
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
    
    public function setAdress($adress)
	{
		if (!is_string($adress) || empty($adress))
		{
			$this->_errors[]=self::INVALID_ADRESS;
		}
		else
		{
			$this->_adress = $adress;
		}
    }
    

    public function setPostalCode($postalCode)
	{
		if (!is_string($postalCode) || empty($postalCode))
		{
			$this->_errors[]=self::INVALID_POSTAL_CODE;
		}
		else
		{
			$this->_postalCode = $postalCode;
		}
    }

    
    public function setCity($city)
	{
		if (!is_string($city) || empty($city))
		{
			$this->_errors[]=self::INVALID_CITY;
		}
		else
		{
			$this->_city = $city;
		}
    }

       public function setCountry($country)
	{
		if (!is_string($country) || empty($country))
		{
			$this->_errors[]=self::INVALID_COUNTRY;
		}
		else
		{
			$this->_country = $country;
		}
    }

}
<?php

class Order
{
    protected $_id,
              $_userId,
              $_userShippingAdressId,
             	$_products = [],
			        $_totalPrice;


  public function __construct($data)
	{
		$this->hydrate($data);
	}

  public function hydrate(object $data)
	{
		foreach ($data as $value)
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

  public function userShippingAdressId()
  {
    return $this->_userShippingAdressId;
  }

	public function products()
	{
		return $this->_products;
	}

	public function totalPrice()
	{
		return $this->_price;
	}


  //SETTERS

	public function setId($id)
	{
		$id = (int)$id;

		$this->_id = $id;
  }
  
  public function setUserId($userId)
	{
		$userId = (int)$userId;

		$this->_userId = $userId;
  }
  
  public function setUserShippingAdressId($userShippingAdressId)
	{
		$userShippingAdressId = (int)$userShippingAdressId;

		$this->_userShippingAdressId = $userShippingAdressId;
	}

	public function setProducts(array $products)
	{
        $this->_products = $products;
		
	}

	public function setTotalPrice($totalPrice)
	{

			$this->_totalPrice = $totalPrice;

	}


}

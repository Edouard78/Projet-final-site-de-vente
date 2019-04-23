<?php

class Order
{
    protected $_id,
              $_userId,
              $_userShippingAdressId,
			        $_total;


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

  public function userShippingAdressId()
  {
    return $this->_userShippingAdressId;
  }

	public function quantity()
	{
		return $this->_quantity;
	}

	public function price()
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

	public function setQuantity($quantity)
	{
        $quantity = (int)$quantity;
        
			$this->_quantity = $quantity;
		
	}

	public function setPrice($price)
	{

			$this->_price = $price;

	}


}

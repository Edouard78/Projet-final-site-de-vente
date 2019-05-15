<?php

class Order
{
    protected $_id,
              $_userId,
              $_userShippingAdressId,
              $_billingAdressSameAs,
             	$_products = [],
			        $_totalPrice,
			        $_date;


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
  public function billingAdress() {
  	return $this->_billingAdress;
  }
  public function billingAdressSameAs() {
  	return $this->_billingAdressSameAs;
  }

	public function products()
	{
		return $this->_products;
	}

	public function totalPrice()
	{
		return $this->_totalPrice;
	}
	public function date()
	{
		return $this->_date;
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
	public function setBillingAdress($billingAdress) {
		$this->_billingAdress = $billingAdress;
	}

	public function setBillingAdressSameAs($billingAdressSameAs) {
		$billingAdressSameAs = intval($billingAdressSameAs);
		$this->_billingAdressSameAs = $billingAdressSameAs;
	}

	public function setProducts(array $products)
	{
        $this->_products = $products;
		
	}

	public function setTotalPrice($totalPrice)
	{

			$this->_totalPrice = $totalPrice;

	}

	public function setDate($date)
	{

			$this->_date = $date;

	}


}

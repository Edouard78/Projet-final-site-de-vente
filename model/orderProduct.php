<?php

class OrderProduct
{
    protected $_id,
    $_userId,
    $_title,
              $_quantity,
			        $_price,
			        $_errors= [];


  public function __construct($data)
	{
		$this->hydrate($data);
	}

  public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
      $key = ltrim($key, '_');
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


  public function title()
	{
		return $this->_title;
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
  
  public function setOrderProductsId($orderProductsId)
	{

    $orderProductsId = (int)$orderProductsId;

			$this->_orderProductsId = $orderProductsId;

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

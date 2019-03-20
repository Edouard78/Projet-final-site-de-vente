<?php

class CheckoutItem
{
    protected $_id,
              $_quantity,
			  $_price;


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

	public function setQuantity($quantity)
	{
        $quantity = (int)$quantity;
        
			$this->_quantity = $quantity;
		
	}

	public function setPrice($price)
	{

			$this->_price = $price;

	}

	public function updateQuantity($newQuantity)
	{
          $this->updatePrice($newQuantity, $this->_quantity);
          
          $this->_quantity = $newQuantity;
    }
    
    public function updatePrice($newQuantity, $previousQuantity)
	{
      
                    
                    if($newQuantity > $previousQuantity ){
                    
                        $this->_price = $this->_price * ( $newQuantity / $previousQuantity) ;


                    }

                    elseif ($newQuantity == $previousQuantity )
                    {
                        $this->_price = $this->_price;

                        

                    }

                    else{

                        $this->_price =  $this->_price / ($previousQuantity /$newQuantity );


                    }


                
	}

}

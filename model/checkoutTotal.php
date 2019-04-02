<?php

class CheckoutTotal
{
    protected $_id,
              $_total;


  public function __construct($data)
	{
		$this->setTotal($data);
	}
			



	//GETTERS

	public function id()
	{
		return $this->_id;
	}

	public function total()
	{
		return $this->_total;
	}



  //SETTERS

	public function setId($id)
	{
		$id = (int)$id;

		$this->_id = $id;
    }
                

	public function setTotal($data)
	{


				foreach ($data as $item)  {
										$this->_total = $this->_total + $item->price();
	
	}
                
    }
    
    public function updateTotal($data)
	{
        $this->_total = 0;
				foreach ($data as $item)  {
                    $this->_total = $this->_total + $item->price();
		
	}

}

}

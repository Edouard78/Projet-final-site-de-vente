<?php

class Cart

{
  public $_id,
         $_products = [],
         $_totalPrice;

  public function __construct($product)

  {
    $this->addProduct($product);
    $this->setTotalPrice($this->_products);
  }
  public function addProduct(CartProduct $product)

  {
    array_push($this->_products ,$product);
  }

  public function updateProduct($id, $newQuantity){
    $this->_products[$id]->updateQuantity($newQuantity);
  }

  public function deleteProduct($productId)
  {
    unset($this->_products[$productId]);
  }
  // GETTERS
  public function id()

  {
    return $this->_id;
  }
  public function products() {
    return $this->_products;
  }
  public function totalPrice()

  {
    return $this->_totalPrice;
  }

  // SETTERS
  public function setId($id)

  {
    $id = (int)$id;
    $this->_id = $id;
  }
  public function setTotalPrice($products)

  {
    foreach($products as $product) {
      $this->_totalPrice = $this->_totalPrice + $product->price();
    }
  }
  public function updateTotalPrice()

  {
    $this->_totalPrice = 0;
    foreach($this->_products as $product) {
      $this->_totalPrice = $this->_totalPrice + $product->price();
    }
  }

  public function store(Cart $cart) {
        $_SESSION['cart'] = $cart;
  }
}


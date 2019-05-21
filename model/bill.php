<?php
require_once('vendor/autoload.php');
class Bill {

    protected $_id,
    $_order,
    $_userShippingAdress,
    $_billingAdress,
    $_paymentMethod,
    $_content,
    $_errors = [];


    CONST INVALID_PAYMENT_METHOD = 1;

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


    public function order()
    {
        return $this->_order;
    }   


    public function userShippingAdress()
    {
        return $this->_userShippingAdress;
    }

    public function billingAdress()
    {
        return $this->_userBillingAdress;
    }   


    public function content()
    {
        return $this->_content;
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

public function setOrder(Order $order)
{
    $this->_order = $order;
}


public function setUserShippingAdress(UserShippingAdress $userShippingAdress)
{
    $this->_userShippingAdress = $userShippingAdress;
}

public function setBillingAdress(BillingAdress $billingAdress)
{
    $this->_billingAdress = $billingAdress;
}

public function setPaymentMethod($paymentMethod)
{
  if (!is_string($paymentMethod) || empty($paymentMethod))
  {
     $this->_errors[]=self::INVALID_PAYMENT_METHOD;
 }
 else
 {
     $this->_paymentMethod = $paymentMethod;
 }
}

public function setContent() {
   ob_start();
   ?>
   <style>
   	.title-brand {
   		text-align : center;
   		font-size: 2em;
    }
    .content {
        margin-top: 40px;
        width: 100%;
    }


    .table-adress {
       width: 100%;
       margin-bottom: 70px;
   }
   .table-adress tr {
    margin : 0 auto;
}

.table-adress td {
    width: 50%;
}


.table-order {
 width : 100%;
 border-collapse: collapse;
}
.table-order .tdQuantity {
   width: 15%;
}

.table-order .tdTitle {
    width: 60%;
}

.table-order .tdPrice {
    width: 25%;
}

.table-order th { 
    border: 1px solid #000;  
    background-color: lightgray; 
    font-weight: normal; 
    font-size: 14px; 
    text-align: center; 
}
.table-order td { 
    border: 1px solid #000;
    text-align: center; 
}
.total-price-intitule {
    text-align: right;
    padding-right: 15px;
}
.total-price {
    background-color: lightgray;
    border : none;
    border: 1px solid #000 !important;
}
.no-border {
    border: 1px transparent;
}
</style>
<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" >
  <page_header class='header'>
  <h1 class='title-brand'>STYLESHOP</h1>
  </page_header>
  <page_footer>
  <hr />
  <p>Merci d'avoir d'avoir commander sur STYLESHOP </p>
  </page_footer>
  <div class='content'>
    <table class="table-adress">
        <tr>
            <td>
                <strong>Adresse de Livraison</strong><br />
                <?php echo $this->_userShippingAdress->name(); ?><br />
                <?php echo $this->_userShippingAdress->adress(); ?><br />
                <?php echo $this->_userShippingAdress->city(); ?><br />
                <?php echo $this->_userShippingAdress->postalCode(); ?><br />
            </td>
            <td>
                <strong>Adresse de Facturation</strong><br />
                <?php echo $this->_billingAdress->name(); ?><br />
                <?php echo $this->_billingAdress->adress(); ?><br />
                <?php echo $this->_billingAdress->city(); ?><br />
                <?php echo $this->_billingAdress->postalCode(); ?><br />
            </td>
        </tr>
    </table>

    <div class='orderDetail'>
       <p>Date de commande : <?php echo $this->order()->date(); ?>
   </p>
   <h2>Commande n°<?php echo $this->_order->id(); ?> :</h2>

</div>

<table class='table-order'>
    <thead>
        <tr>
            <th>Quantité</th>
            <th>Produit</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->_order->products() as $product): ?>
            <tr>
            	
                <td class='tdQuantity'><?php echo $product->quantity(); ?></td>
                <td class='tdTitle'><?php echo $product->title(); ?></td>
                <td class='tdPrice'><?php echo $product->price(); ?> euros</td>
            </tr>
        <?php endforeach ?>

        <tr>
            <td class='no-border'></td>
            <td class='total-price-intitule no-border'><strong>Prix Total:</strong></td>
            <td class='total-price'><?php echo $this->_order->totalPrice(); ?> euros</td>
        </tr>
    </tbody>
</table>
</div>

</page>
<?php
$this->_content = ob_get_clean();
}

public function generatePDF() {
   $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P','A4','fr');
   $html2pdf->writeHTML($this->content());
   $html2pdf->output();
}

}   
<?php
ob_start();
?>


<script src="https://js.stripe.com/v3/"></script>

<script src="public/js/charge.js"></script>


<div class="container">

<h3>Paiement</h3>
<br>
<?php
if (isset($_GET['error']))
{
  if ($_GET['error'] == 1)
  {
?>
<div class="alert alert-danger">
    <strong>Un ou plusieurs champs sont incorrect</strong>
</div>
<br>
<?php } } ?>
<form action="charge.php?action=submitPayment" method="post" id="payment-form">
  <div class="form-row">

    </select>
    <input type="text" name="first-name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prénom">
    <input type="text" name="last-name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom">

    <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email">

    <div id="card-element" class="form-control">
    </div>

    <div id="card-errors" role="alert"></div>
  </div>

  <button>Valider Paiement</button>
</form>
<br><br>
<div class='paymentInfos pull-right' style='display:flex;'>
<p style='font-size: 1em;margin-top: 1em; padding-right: 0.5em;'>Avec </p>  <div class="fa fa-cc-stripe " style='font-size:3em;'></div>
</div>
</div>



<?php
$content = ob_get_clean();
require ('view/template.php');

?>
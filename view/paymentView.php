<?php
ob_start();
?>


<script src="https://js.stripe.com/v3/"></script>

<script src="public/js/charge.js"></script>


<h3>Paiement</h3>
<div class="container" style='display:flex;align-items: center;'>


<form action="charge.php?action=submitPayment" method="post" id="payment-form" style='width:65%'>
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

<em class="fa fa-cc-stripe " style='font-size:8em;margin:0 auto;'></em>
</div>


<?php
$content = ob_get_clean();
require ('view/template.php');

?>
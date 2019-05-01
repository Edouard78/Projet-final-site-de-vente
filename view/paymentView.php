<?php
ob_start();
?>


<script src="https://js.stripe.com/v3/"></script>

<script src="public/js/charge.js"></script>



<div class="container">


<form action="controller/charge?action=submitPayment" method="post" id="payment-form">
  <div class="form-row">

    </select>
    <input type="text" name="first-name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prénom">
    <input type="text" name="last-name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom">

    <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email">

    <div id="card-element" class="form-control">
    </div>

    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
</form>
</div>


<?php
$content = ob_get_clean();
require ('view/template.php');

?>
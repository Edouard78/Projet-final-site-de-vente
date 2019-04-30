<?php
ob_start();
?>


<div class="container">


<form action="index.php?action=validateOrder" method="post" id="payment-form">
 <fieldset>
 <legend>Adresse de Livraison</legend>
  <div class="form-group">
    <label for="userShippingAdressSelection">Selectionnez votre Adresse de Livraison :</label>
    <select class="form-control"  name="userShippingAdress" id="userShippingAdressSelection">
    <?php while ($data = $userShippingAdress->fetch())
	{ 
    ?>
    <option value="<?php echo $data['id']; ?>" selected><?php echo $data['title']; ?></option>
  </div>
  <?php
  }
  ?>
    </select>
</div>
</fieldset>
<fieldset>
  <legend>Adresse de facturation</legend>
  <div class="form-group">
    <input type="text" name="fullName" class="form-control" placeholder="Nom complet">
  </div>
  <div class="form-group">
    <input type="text" name="adress" class="form-control" placeholder="Adresse">
  </div>
  <div class="form-group">
    <input type="text" name="postalCode" class="form-control" placeholder="Code postal">
</div>
  <div class="form-group">
    <input type="text" name="city" class="form-control" placeholder="Ville">
</div>
  <div class="form-group">
    <input type="text" name="country" class="form-control" placeholder="Pays">
  </div>
<div class="form-group">
  <button>Valider la commande et passer au paiement (obligatoire)</button>
</div>
<fieldset>
</form>
</div>


<?php
$content = ob_get_clean();
require ('view/template.php');

?>
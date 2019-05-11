<?php
ob_start();
?>


<div class="container">


<form action="index.php?action=submitOrderInfos" method="post" id="payment-form">
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
<fieldset id='billing'>
  <legend>Adresse de facturation</legend>
  <div class='form-group'>

  <label for="billing-adress-identical">Identique à l'adresse de Livraison</label>
  <input type="checkbox" id="billing-adress-identical" name="billing-adress-identical" checked>

  </div>
  <div id='billing-form'>
  <div class='form-group'>
  <span class='btn btn-light' type='button' id='billing-adress-add-btn'>Ajouter une autre adresse</span>
  </div>
  </div>
<fieldset>
  <button type='submit' class='btn btn-primary btn-block'>Valider la commande et passer au paiement (obligatoire)</button>
</form>
</div>


<script>
  let addBillingAdressBtn = document.getElementById('billing-adress-add-btn');
  let billingFieldSetElt = document.getElementById('billing');
  let billingAdressIdenticalElt = document.getElementById('billing-adress-identical');
  let billingForm = document.getElementById('billing-form');

  addBillingAdressBtn.addEventListener('click' , function(e){
    e.preventDefault();
    billingForm.innerHTML = '';

  billingAdressIdenticalElt.checked = false;

      let formGroupElt1 = document.createElement('div');
      formGroupElt1.className = 'form-group';

      let inputElt1 = document.createElement('input');
      inputElt1.className = 'form-control';
      inputElt1.setAttribute('name', 'fullName');
      inputElt1.setAttribute('placeholder', 'Nom complet');

      formGroupElt1.appendChild(inputElt1);
      billingForm.appendChild(formGroupElt1);

      let formGroupElt2 = document.createElement('div');
      formGroupElt2.className = 'form-group';

      let inputElt2 = document.createElement('input');
      inputElt2.className = 'form-control';
      inputElt2.setAttribute('name', 'adress');
      inputElt2.setAttribute('placeholder', 'Adresse');
      
      formGroupElt2.appendChild(inputElt2);
      billingForm.appendChild(formGroupElt2);

       let formGroupElt3 = document.createElement('div');
      formGroupElt3.className = 'form-group';

      let inputElt3 = document.createElement('input');
      inputElt3.className = 'form-control';
      inputElt3.setAttribute('name', 'postalCode');
      inputElt3.setAttribute('placeholder', 'Code postal');
      
      formGroupElt3.appendChild(inputElt3);
      billingForm.appendChild(formGroupElt3);


       let formGroupElt4 = document.createElement('div');
      formGroupElt4.className = 'form-group';

      let inputElt4 = document.createElement('input');
      inputElt4.className = 'form-control';
      inputElt4.setAttribute('name', 'city');
      inputElt4.setAttribute('placeholder', 'Ville');
      
      formGroupElt4.appendChild(inputElt4);
      billingForm.appendChild(formGroupElt4);

      let formGroupElt5 = document.createElement('div');
      formGroupElt5.className = 'form-group';

      let inputElt5 = document.createElement('input');
      inputElt5.className = 'form-control';
      inputElt5.setAttribute('name', 'country');
      inputElt5.setAttribute('placeholder', 'Pays');
      
      formGroupElt5.appendChild(inputElt5);
      billingForm.appendChild(formGroupElt5);
      

  })

  billingAdressIdenticalElt.addEventListener('change', function(e) {
    if (e.target.checked == true) {
      billingForm.innerHTML = '';
  }
  });


</script>
<?php
$content = ob_get_clean();
require ('view/template.php');

?>


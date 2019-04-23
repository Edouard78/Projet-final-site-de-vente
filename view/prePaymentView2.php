<?php
ob_start();
?>


<div class="container">

<h3>Recapitulatif Commande</h3>


  <a type="button" action="index.php?action=validateOrder">Valider la commande et passer au paiement</button>



<?php
$content = ob_get_clean();
require ('view/template.php');

?>
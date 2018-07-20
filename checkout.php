<?php
require_once 'controller/checkoutController.php';
$c = new checkoutController;
return isset($_POST['btncheckout'])? $c->checkout() : $c->getcheckoutPage();
?>
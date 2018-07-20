<?php
require_once 'controller/cartController.php';
$c = new cartController;
return $c->loadShoppingCart();

?>
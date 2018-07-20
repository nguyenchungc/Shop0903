<?php
require_once 'controller/checkoutController.php';
$c = new checkoutController;
return $c->acceptOrder();
?>
<?php
require_once 'controller/accountController.php';
$c = new accountController;
return $c->getAccountPage();

?>
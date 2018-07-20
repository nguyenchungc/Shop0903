<?php
require_once 'controller/blogController.php';
$c = new blogcontroller;
return $c->getBlogPage();

?>
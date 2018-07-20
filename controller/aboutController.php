<?php
require_once 'Controller.php';
class aboutController extends Controller {

    function getaboutPage(){
            
            return $this->loadView('about');

    }

}

?>
<?php
require_once 'Controller.php';
class contactController extends Controller {

    function getcontactPage(){
            
            return $this->loadView('contact');

    }

}

?>
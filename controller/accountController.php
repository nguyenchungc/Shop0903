<?php
require_once 'Controller.php';
class accountController extends Controller {

    function getAccountPage(){
            
            return $this->loadView('account');

    }
    
    

}

?>
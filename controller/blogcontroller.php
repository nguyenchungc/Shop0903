<?php
require_once 'Controller.php';
class blogcontroller extends Controller {

    function getBlogPage(){
            
            return $this->loadView('blog');

    }

}

?>
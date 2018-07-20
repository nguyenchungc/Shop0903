<?php
include_once 'Controller.php';
include_once 'model/HomeModel.php';
class homeController extends Controller {

    function getHomePage(){
            $model = new HomeModel;
            $slides = $model->selectSlide();
            $featuredProduct = $model->selectFeaturedProduct();
            $NewProduct = $model->NewProduct();
            $onsalelProducts = $model->onsale();
            $Topsale = $model->TopSale();
            $data = [
                'slides'=>$slides,
                'featuredProduct'=>$featuredProduct,
                'NewProduct'=>$NewProduct,
                'onsaleProduct'=>$onsalelProducts,
                'TopSaleProduct'=>$Topsale,
            ];

            
            return $this->loadView('home', $data);

    }

}

?>
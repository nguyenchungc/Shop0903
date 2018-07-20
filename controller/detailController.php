<?php
require_once 'Controller.php';
include_once 'model/DetailModel.php';
class detailController extends Controller {

    function getDetailpage(){

        $alias = $_GET['alias'];
        $id = $_GET['id'];


        $model = new DetailModel;

        $detail = $model->getDetailProduct($alias, $id);

        $idType = $detail->id_type;
        $relatedProducts = $model->SelectProductByType($idType,$id);
        
            $data = [

                'detail'=>$detail,
                'relatedProducts'=>$relatedProducts
            ];
            $this->loadView('detail',$data, $detail->name);

    }

}

?>
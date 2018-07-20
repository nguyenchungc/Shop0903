<?php
require_once 'Controller.php';
include_once 'model/TypeModel.php';
include_once 'helper/pager.php';
class TypeController extends Controller {

    function LoadPageType(){
        $alias = isset($_GET['type'])? $_GET['type']:'';
        $page = ISSET($_GET['page']) && $_GET['page']>0 && is_numeric($_GET['page']) ? $_GET['page'] :1;
        $qty =9;
        $pageShow= 5;
        $position =($page-1)*$qty;

        if ($alias ==''){
            header('location:404.php');
            return;
        }
        $model = new TypeModel;
        $type =$model->getNameType($alias);

        $products = $model->selectProductLevel2($alias);
        $totalProduct = count($model->selectProductLevel2($alias,-1,-1));
      
        


        if(count($products) == 0){
            $products = $model->selectProductLevel1($alias);
            $totalpage = count($model->selectProductLevel1($alias,-1,-1));
        }

        $pager = new Pager($totalProduct,$page,$qty,$pageShow);
        $pagination = $pager->showPagination();
        $allType = $model->selectALLType();
        $data = [
            'ALLType' =>$allType,
            'products'=>$products,
            'nametype'=>$type->name,
            'pagination'=>$pagination
        ];
            
        return $this->loadView('type',$data, $type->name);

    }
    function AjaxCategories(){
        $alias = $_GET['alias'];
        $model = new TypeModel;
        $products = $model->selectProductLevel2($alias);
        $data =[
            'products'=>$products,
            'alias'=>$alias
        ];
        return $this->loadViewAjax('categories',$data);

    }



}

?>
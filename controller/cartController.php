<?php
include_once 'Controller.php';
include_once 'model/DetailModel.php';
include_once 'helper/cart.php';
session_start();
class cartController extends Controller{
    
    function loadShoppingCart(){
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        return $this->loadView('shopping-cart',$cart,"Giỏ hàng của bạn");
    }

    function addtocart(){
            $id = $_POST['id'];
            
            $qty = isset($_POST['qty'])? (int)$_POST['qty'] : 1;
            $model = new DetailModel;
            $product = $model->SelectProductByID($id);

            $oldcart = isset($_SESSION['cart'])? $_SESSION['cart'] :null;
            $cart = new Cart($oldcart);
            $cart->add($product,$qty);
            $_SESSION['cart'] = $cart;
        //print_r($id);die;
            
            echo $cart->items[$id]['item']->name;
            

    }
    

    function deleteCart(){
        $id = $_POST['id'];
        $oldcart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldcart);
        $cart->removeItem($id);
        $_SESSION['cart'] = $cart;
        echo json_encode([
            'totalPrice' =>number_format($cart->totalPrice),
            'promtPrice' =>number_format($cart->promtPrice)
        ]);
       

        //print_r($_SESSION['cart']);
    }

    function updateCart(){
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $model = new DetailModel;
        $product = $model->SelectProductByID($id);

        $oldcart = isset($_SESSION['cart'])? $_SESSION['cart'] :null;
        $cart = new Cart( $oldcart );
        $cart -> update($product,$qty);
        $_SESSION['cart'] = $cart;
        
        echo json_encode([
            'discountPrice' =>number_format($cart->items[$id]['discountPrice']),
            'totalPrice' =>number_format($cart->totalPrice),
            'promtPrice' =>number_format($cart->promtPrice)
        ]);

        
    }

}

?>
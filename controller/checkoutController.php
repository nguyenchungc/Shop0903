<?php
require_once 'Controller.php';
include_once 'model/checkoutModel.php';
include_once 'helper/cart.php';
include_once 'helper/functions.php';
include_once 'helper/PHPMailer/mailer.php';
session_start();
class checkoutController extends Controller {

    function getcheckoutPage(){ return $this->loadView('checkout');}
    function checkOut(){
        $email = $_POST['email'];
        $name = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        
        $model = new CheckoutModel();
        $idCustomer = $model->saveCustomer($name, $email, $address, $phone);
        if($idCustomer){
            //save bill
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
            if($cart==null){
                header('location:index.php'); 
                return;
            }
             //print_r($cart);
            //die;
            $dateOrder = date('Y-m-d',time());
            $promtPrice = $cart->promtPrice;
            $total = $cart->totalPrice;
            
            $token = createToken();

           
            $tokenDate = strtotime(date('Y-m-d H:i:s',time()));
            $idBill = $model->saveBill($idCustomer, $dateOrder,$promtPrice, $total, $note,$token, $tokenDate);
            //print_r($idBill);
            //die;
            if($idBill){
                //save bill detail
                foreach($cart->items as $id=>$sp){
                    $idProduct = $id;
                    $qty = $sp['qty'];
                    $price = $sp['discountPrice'];
                    $check = $model->saveBillDetail($idBill,$idProduct, $qty, $price);
                    if(!$check){
                        //delete customer, bill
                        $model->deleteCustomer($idCustomer);
                        $model->deleteBill($idBill);
                        $model->deleteBillDetail($idBill);
                        
                        $_SESSION['error'] = "Có lỗi xảy ra 1, vui lòng thử lại";
                        header('location:checkout.php');
                        return;
                    }
                }
               
                //http://localhost/shop0903/asdfghfggewsrw2356334/12345678765
                $link = "http://localhost/shop0903/$token/$tokenDate";
                $subject = "Xác nhận đơn hàng DH00 $idBill";
                $content = "<did>Chào bạn, $name,</did>
                            <div>Cảm ơn bạn đã đặt hàng, tổng tiền thanh toán là: <b>".number_format($promtPrice). " vnđ</b>.
                            <br></div>
                            <div>Vui lòng chọn vào <a href='$link'>đây</a> để xác nhận đơn hàng.</div>";
                sendMail($email, $name,$subject,$content);
                $_SESSION['success'] = "Vui lòng kiểm tra hộp thư để xác nhận đơn hàng";
                unset($_SESSION['cart']);
                header('location:checkout.php');
                return;
            }
            else{
                //delete customer
                $model->deleteCustomer($idCustomer);
                $_SESSION['error'] = "lỗi 2, vui lòng thử lại";
                header('location:checkout.php');
                return;
            }
            
        }
        else{
            $_SESSION['error'] = "Có lỗi xảy ra 3, vui lòng thử lại";
            header('location:checkout.php');
            return;
        }
        
    }
    function acceptOrder(){
        $token = $_GET['token'];
        $oldTime = $_GET['t'];
        $now = strtotime(date('y-m-d H:i:s',time()));

        if($now-$oldTime <= 86400){
            $model = new checkOutModel();
            $bill = $model ->findBillByToken($token);
            if($bill){
                //update status
                //print_r($bill); die;
                $model ->updateStatusBill($bill->id);
                $_SESSION['success'] = "đã đặt hàng thành công"; 
            }
            else {
                $_SESSION['error'] ="liên kết bạn không hợp lệ";
            }
        }
        else {

            $_SESSION['error'] ="liên kết hết hạn";
        }
        header("location: http://localhost/shop0903/checkout.php");
    }

}

?>
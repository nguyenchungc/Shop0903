<?php

require_once 'DBConnect.php';
class checkoutModel extends DBConnect{
    function saveCustomer($name,$email,$address,$phone){
        $sql = "INSERT INTO customers(name,email,address,phone)
        VALUE ('$name','$email','$address','$phone')";

        $result = $this->executeQuery($sql);
        return $result ? $this->getLastId() : false;
    }
    function saveBill($idCustomer, $dateOrder, $promtPrice,$total, $note,$token, $tokenDate){
        $sql = "INSERT INTO bills(id_customer,date_order,promt_price,total, note, token, token_date)
        VALUE ($idCustomer, '$dateOrder', $promtPrice,$total, '$note','$token', '$tokenDate')";
        //echo $sql; die;
        $result = $this->executeQuery($sql);
        return $result ? $this->getLastId() : false;
    }
    function saveBillDetail($idBill,$idProduct, $qty, $price){
        $sql ="INSERT INTO bill_detail(id_bill,id_product,quantity,price)
                VALUE ($idBill,$idProduct, $qty, $price)";
        return $this->executeQuery($sql);
    }
    function deleteCustomer($id){
        $sql="DELETE FROM customers WHERE id=$id";
        $result = $this->executeQuery($sql);
    }
    function deleteBill($id){
        $sql="DELETE FROM bills WHERE id=$id";
        $result = $this->executeQuery($sql);
    }
    function deleteBillDetail($idBill){
        $sql="DELETE FROM bill_detail WHERE id_bill=$idBill";
        $result = $this->executeQuery($sql);
    }
    function findBillByToken($token){
        $sql ="SELECT * FROM bills WHERE token ='$token'";
        return $this->loadOneRow($sql);

    }
    function updateStatusBill($id){
        $sql = "UPDATE bills SET status = 1, 
                token ='',
                token_date=''
                WHERE id= $id";
            
        return $this->executeQuery($sql);
    }

}
?>
<?php

include_once "DBConnect.php";
class HomeModel extends DBConnect{

    function selectSlide(){
        $sql = "SELECT * FROM slide WHERE status =1";
        return $this->loadMoreRows($sql);
    }
    function selectFeaturedProduct(){

        $sql ="SELECT p.*, u.url FROM products p INNER JOIN page_url u ON p.id_url = u.id WHERE p.status=1";
        return $this->loadMoreRows($sql);
    }
    function NewProduct(){

        $sql = "SELECT p.*, u.url
                FROM products p 
                INNER JOIN page_url u 
                ON u.id = p.id_url
                WHERE new =1
                LIMIT 0,10";
        return $this->loadMoreRows($sql);
    }
    function onsale(){

        $sql ="SELECT p.*, u.url FROM products p INNER JOIN page_url u ON p.id_url = u.id WHERE promotion_price !=0 LIMIT 0,3";
        return $this->loadMoreRows($sql);
    }
    function TopSale(){
        
        $sql ="SELECT p.* ,u.url, sum(b.quantity) as qlt
        FROM products p 
        INNER JOIN bill_detail b 
        ON p.id = b.id_product
        INNER JOIN page_url u
        ON u.id = p.id_url 
        GROUP BY b.id_product 
        ORDER BY qlt DESC 
        LIMIT 0,10";
        return $this->loadMoreRows($sql);

    }

}



?>
<?php
class TypeModel extends DBConnect {

    function selectProductLevel2($alias, $position =0, $qty=9){
        $sql ="SELECT p.*, u.url
        FROM products p
        INNER JOIN page_url u
        ON u.id = p.id_url
        WHERE p.id_type = (
        SELECT c.id
        FROM categories c
        INNER JOIN page_url u
        ON c.id_url = u.id
        WHERE u.url = '$alias')";
        if($position>=0 && $qty >0){
            $sql .= " LIMIT $position, $qty";

        }
    return $this->LoadMoreRows($sql);
    }

    function getNameType($alias){

        $sql = "SELECT c.name
        FROM categories c
        INNER JOIN page_url u
        ON c.id_url = u.id
        WHERE u.url = '$alias'";
    return $this->loadOneRow($sql);
    }

    function selectProductLevel1($alias, $position =0, $qty=9){
        $sql = "SELECT p.*, pu.url
        FROM products p
        INNER JOIN page_url pu
        ON p.id_url = pu.id
        WHERE p.id_type IN(
            SELECT c2.id
            FROM categories c2
            WHERE id_parent=(
                SELECT c.id
                FROM categories c
                INNER JOIN page_url u
                ON c.id_url = u.id
                WHERE u.url = '$alias')
            ) ";
            if($position>=0 && $qty >0){
                $sql .= " LIMIT $position, $qty";

            }
            

        return $this->loadMoreRows($sql);
    }
    function selectALLType(){

        $sql ="SELECT count(p.id) as soluong, c.name, pu.url
        FROM products p
        INNER JOIN categories c
        ON p.id_type = c.id
        INNER JOIN page_url pu
        ON c.id_url=pu.id
        GROUP BY c.id";
        return $this->loadMoreRows($sql);
    }
    function selectALLTypebyPrice(){
        $sql ="SELECT count(p.id) as price, c.name, pu.url
        FROM products p
        INNER JOIN categories c
        ON p.id_type = c.id
        INNER JOIN page_url pu
        ON c.id_url=pu.id
        WHERE p.price BETWEEN 20000000 AND 30000000
        return $this->loadMoreRows($sql)";

    }
}



?>
<?php
$user_id = 2;
include "../../auth/db.php";

    $products_posted="SELECT * from orders WHERE user_id ='$user_id'";                
    $results=mysqli_query($conn,$products_posted);                 
        while($row = $results -> fetch_assoc()){
            $product_id = $row['product_id'];
            $products_ordered="SELECT * from products WHERE product_id = $product_id ";  
            $res=mysqli_query($conn,$products_ordered);
            while($fetch = $res-> fetch_assoc()){
                $orderHistory[] = $fetch;
            }
        }
        echo json_encode($orderHistory);
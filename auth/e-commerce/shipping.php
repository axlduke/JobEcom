<?php
 include '../db.php';
 session_start();
        $product_id = $_GET['product_id'];
        $trx_id = $_GET['trx_id'];
        $sql2 = "UPDATE orders SET order_status = 'Shipped' WHERE trx_id = '$trx_id' and product_id ='$product_id'";
        $res = mysqli_query($conn, $sql2);
        if($res){
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Shipped";
            $_SESSION['status_text'] = "The order has been shipped";              
            header("Location: ../../e-com/ecommerce-order-list.php");
         
        }
        else{

            echo 'error';
        }
       
?>


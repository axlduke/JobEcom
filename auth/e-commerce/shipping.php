<?php
 include '../db.php';
    // $_POST['update_status'];
        $product_id = $_GET['product_id'];
        $trx_id = $_GET['trx_id'];
        $sql2 = "UPDATE orders SET order_status = 'Shipped' WHERE trx_id = '$trx_id' and product_id ='$product_id'";
        $res = mysqli_query($conn, $sql2);
        if($conn->query($sql2) === TRUE){
            header("Location: ../../e-com/ecommerce-order-list.php");
         
        }
        else{

            echo 'error';
        }
       
?>


<?php
    session_start();
    include '../db.php';
    $user_id = $_SESSION['user_id'];
    $trx_id = $_GET['trx_id'];
    $order_status = 'Order Received';
    
    if($order_status == 'Order Received'){
        $sql2 = "UPDATE orders SET order_status = '$order_status' WHERE trx_id = '$trx_id' AND user_id = '$user_id'";
        $res = mysqli_query($conn, $sql2);
        if($conn->query($sql2) === TRUE){
            header("Location: ../../user/user-order-history.php");
        }
    } else{
        echo "<script>
            alert('Your Order has on process please wait to turn your item in Shipping status');
            document.location.href = '../../user/user-order-history.php'
            </script>";
    }
    
?>
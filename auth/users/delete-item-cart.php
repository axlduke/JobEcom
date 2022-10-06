<?php
    session_start();
    include '../db.php';

    $i = $_GET['i'];
    $query = "DELETE FROM cart WHERE cart_id ='$i' ";
    if($conn->query($query) === TRUE){
        // header("Location: ../../user/ecommerce-details.php"); 
        $referer = $_SERVER['HTTP_REFERER'];
                header("Location: $referer"); 
    }
?>
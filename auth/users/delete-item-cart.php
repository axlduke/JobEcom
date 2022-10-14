<?php
    session_start();
    include '../db.php';

    $i = $_GET['i'];
    $query = "DELETE FROM cart WHERE cart_id ='$i' ";
    if($conn->query($query) === TRUE){
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_title'] = "Item removed!";
        $_SESSION['status_text'] = "The item has been removed to your cart";  
        $referer = $_SERVER['HTTP_REFERER'];
                header("Location: $referer"); 
    }
?>
<?php 
session_start();
include '../db.php';
$seller_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    $query = "DELETE FROM products WHERE product_id ='$id' ";
    if($conn->query($query) === TRUE){
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_title'] = "Product Deleted!";
        $_SESSION['status_text'] = "Your product has been deleted";     	
        header('location: ../../e-com/ecommerce-posted-products.php');
    }
?>
<?php         
    session_start();
    include '../db.php';
    if (isset($_POST['add-cart-action'])){
        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];
        $quantity = $_POST['quantity'];
        $seller_id = $_POST['seller_id'];
        $check =mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id ='$product_id'");
        if(mysqli_num_rows($check) > 0){
            // echo '<script>window.alert("Email is already taken")</script>';
            $update = "UPDATE cart set quantity=quantity+$quantity  WHERE user_id = '$user_id' AND product_id ='$product_id'";
            $res = mysqli_query($conn, $update);
            if($res){
                $referer = $_SERVER['HTTP_REFERER'];
                header("Location: $referer"); 
                }            
        }else{
        $sql = "INSERT INTO `cart`(`product_id`, `user_id`, `seller_id`, `quantity`) VALUES ('$product_id','$user_id','$seller_id','$quantity')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer"); 
            }
        }            
    }
    if (isset($_POST['buy-now-action'])){
        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];
        $quantity = $_POST['quantity'];
        $seller_id = $_POST['seller_id'];
        $sql = mysqli_query($conn,"INSERT INTO `cart`(`product_id`, `user_id`, `seller_id`, `quantity`) VALUES ('$product_id','$user_id','$seller_id','$quantity')");
        header("Location: ../../user/ecommerce-checkout.php");
    }
// ?>

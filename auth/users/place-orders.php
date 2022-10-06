<?php         
    session_start();
    include '../db.php';
    if (isset($_POST['place-order-cod'])){
        $user_id = $_SESSION['user_id'];
        $fname = $_POST['fname'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
        $trx_id = "TRXMA-".strtoupper(uniqid());        
        $sql = "SELECT * FROM cart where user_id= $user_id ";
        $result = mysqli_query($conn, $sql);
         while($row = $result -> fetch_assoc()){
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $order = "INSERT INTO `orders`(`product_id`, `user_id`, `fname`, `phone`, `complete_address`, `zip_code`, `quantity`,`trx_id`,`date_ordered`) VALUES ('$product_id','$user_id','$fname','$contact','$address','$zipcode','$quantity','$trx_id',CURRENT_TIMESTAMP)";
            if ($conn->query($order)) {
                $remove_from_cart = mysqli_query($conn, "DELETE FROM cart WHERE `product_id` ='$product_id' and user_id =$user_id");
                $checkout = mysqli_query($conn,"UPDATE products SET quantity=quantity-$quantity WHERE product_id='$product_id'");
                header('Location: ../../user/thankyou-page.php');

            }        
         }            
        }
?>  

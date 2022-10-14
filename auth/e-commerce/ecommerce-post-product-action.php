<?php 
session_start();
include '../db.php';
$seller_id = $_SESSION['user_id'];
// echo $seller_id;
    if(isset($_POST['post_product'])){
        $location="product_images/";
        $file1=$_FILES['img1']['name'];
        $file_tmp1=$_FILES['img1']['tmp_name'];
        $file2=$_FILES['img2']['name'];
        $file_tmp2=$_FILES['img2']['tmp_name'];
        $file3=$_FILES['img3']['name'];
        $file_tmp3=$_FILES['img3']['tmp_name'];
        $file4=$_FILES['img4']['name'];
        $file_tmp4=$_FILES['img4']['tmp_name'];
        $file5=$_FILES['img5']['name'];
        $file_tmp5=$_FILES['img5']['tmp_name'];

        $product_name=  trim(mysqli_real_escape_string($conn, $_POST['product_name']));
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];
		$product_description= trim(mysqli_real_escape_string($conn, $_POST['product_description']));
		$product_category=$_POST['product_category'];
		$shipping_fee= $_POST['shipping_fee'];
        $brand = trim(mysqli_real_escape_string($conn, $_POST['brand']));
        $sql = "INSERT INTO products (seller_id, brand, product_name, quantity,price,product_description, product_category, file1,file2,file3,file4,file5) 
        VALUES ('$seller_id', '$brand', '$product_name','$quantity','$price','$product_description','$product_category','$file1','$file2','$file3','$file4','$file5')";
        $result = mysqli_query($conn, $sql); 
        if($result){
            move_uploaded_file($file_tmp1, $location.$file1);
            move_uploaded_file($file_tmp2, $location.$file2);
            move_uploaded_file($file_tmp3, $location.$file3);
            move_uploaded_file($file_tmp4, $location.$file4);
            move_uploaded_file($file_tmp5, $location.$file5);
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Product Posted!";
            $_SESSION['status_text'] = "You have successfully posted your product";              
            header('location: ../../e-com/ecommerce-posted-products.php');
            
        }

    }

    if (isset($_POST['post_update'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];
		$product_description=$_POST['product_description'];
		$product_category=$_POST['product_category'];
		$shipping_fee= $_POST['shipping_fee'];
        $brand = $_POST['brand'];
        $sql = "UPDATE products SET brand = '$brand', product_name = '$product_name', quantity = '$quantity',price = '$price',product_description = '$product_description', product_category = '$product_category' WHERE product_id = '$product_id' and seller_id = '$seller_id'";
        $result = mysqli_query($conn, $sql); 
        if($result){
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Product Updated!";
            $_SESSION['status_text'] = "You have successfully updated your product";              
           header('location: ../../e-com/ecommerce-posted-products.php');
        }
    }

    // $id = $_GET['id'];
    // $query = "DELETE FROM products WHERE product_id ='$id' ";
    // if($conn->query($query) === TRUE){
    //     header('location: ../../e-com/ecommerce-posted-products.php');
    // }

?>
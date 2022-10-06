<?php 
session_start();
include_once '../db.php';
$user_id = $_SESSION['user_id'];
if (isset($_POST['review_button'])) {
	$location="../../img/products_review/";
	$file1=$_FILES['img1']['name'];
	$file_tmp1=$_FILES['img1']['tmp_name'];
	$file2=$_FILES['img2']['name'];
	$file_tmp2=$_FILES['img2']['tmp_name'];
	$file3=$_FILES['img3']['name'];
	$file_tmp3=$_FILES['img3']['tmp_name'];
	$file4=$_FILES['img4']['name'];
	$file_tmp4=$_FILES['img4']['tmp_name'];	
	$profile_pict = $_POST['profile_pict'];
	$product_id = $_POST['product_id'];
	$like = $_POST['rating'];
	$dislike = 5 - $like;
	$date = date('Y-m-d H:i:s');
	$user_review = trim(mysqli_real_escape_string($conn, $_POST['user_review']));
	$sql = "INSERT INTO product_reviews (product_id, user_id, star_like, star_dislike, user_review, review_picture_1, review_picture_2,review_picture_3,review_picture_4, date_review) 
        VALUES ('$product_id', '$user_id','$like','$dislike','$user_review','$file1','$file2','$file3','$file4', '$date')";
	$result = mysqli_query($conn, $sql); 
	        if($result){
	            move_uploaded_file($file_tmp1, $location.$file1);
	            move_uploaded_file($file_tmp2, $location.$file2);
	            move_uploaded_file($file_tmp3, $location.$file3);
	            move_uploaded_file($file_tmp4, $location.$file4);
	            // move_uploaded_file($file_tmp5, $location.$file5);
	            $referer = $_SERVER['HTTP_REFERER'];
                header("Location: $referer"); 
	            
	        }
	}

?>
<?php 
    include "../db.php";
    session_start();
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['updateProfile'])){

        $location="../../img/profile/";
        $file1=$_FILES['profile']['name'];
        $file_tmp1=$_FILES['profile']['tmp_name'];

        $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
        $contact = $_POST['contact'];
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $address = trim(mysqli_real_escape_string($conn, $_POST['address']));
    
        $sql1 = "UPDATE user SET fname = '$fname', contact = '$contact', email = '$email', `address` = '$address',
        pictures = '$file1' WHERE `user_id` ='$user_id'";
        $result = mysqli_query($conn, $sql1);
        if($result){
            move_uploaded_file($file_tmp1, $location.$file1);
            header('location: ../../e-com/page-account-settings.php');
            // echo "Error";
        }
    }
?>
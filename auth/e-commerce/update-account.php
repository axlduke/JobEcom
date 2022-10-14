<?php 
    include "../db.php";
    session_start();
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['updateProfile'])){
        if ($_FILES['profile']['size'] == 0 && $_FILES['profile']['name'] == "") {
            $file1=trim(mysqli_real_escape_string($conn,$_POST['outdated_profile']));
        }else{
        $location="../../img/profile/";
        $file1=$_FILES['profile']['name'];
        $file_tmp1=$_FILES['profile']['tmp_name'];
        }
        $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
        $contact = $_POST['contact'];
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $address = trim(mysqli_real_escape_string($conn, $_POST['address']));
    
        $sql1 = "UPDATE user SET fname = '$fname', contact = '$contact', email = '$email', `address` = '$address',
        pictures = '$file1' WHERE `user_id` ='$user_id'";
        $result = mysqli_query($conn, $sql1);
        if($result){
            if ($_FILES['profile']['size'] == 0 && $_FILES['profile']['error'] == 0){
                // code...
            }
            else{
<<<<<<< HEAD
            move_uploaded_file($file_tmp1, $location.$file1);
=======
                move_uploaded_file($file_tmp1, $location.$file1);
            }
            $_SESSION['status_icon'] = "success";
            $_SESSION['status_title'] = "Account Updated!";
            $_SESSION['status_text'] = "You have successfully updated your account";             
>>>>>>> 08534abab1296de23dbaa098d22ce384f56ebf9a
            header('location: ../../e-com/page-account-settings.php');
            // echo "Error";
        }
    }
?>
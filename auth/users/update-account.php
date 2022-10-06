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
        $title = trim(mysqli_real_escape_string($conn, $_POST['title']));
        $fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
        $contact = $_POST['contact'];
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $address = trim(mysqli_real_escape_string($conn, $_POST['address']));
        $mode = $_POST['mode'];
        $about = trim(mysqli_real_escape_string($conn, $_POST['about']));
    
        $sql1 = "UPDATE user SET title = '$title', fname = '$fname', contact = '$contact', email = '$email', `address` = '$address', mode = '$mode', about = '$about',
        pictures = '$file1' WHERE `user_id` ='$user_id'";
        $result = mysqli_query($conn, $sql1);
        if($result){
            if ($_FILES['profile']['size'] == 0 && $_FILES['profile']['error'] == 0){
                // code...
            }
            else{
                move_uploaded_file($file_tmp1, $location.$file1);
            }
            
            header('location: ../../user/user-account-settings.php');
            // echo "Error";
        }
    }
?>
<?php 
    include "../db.php";
    session_start();
    $user_id = $_SESSION['user_id'];
    
    if(isset($_POST['updatePassword'])) {
        // $email = $_POST['email'];
        $Opassword = $_POST['password'];
        $Npassword = $_POST['Npassword'];
        $Rpassword = $_POST['Rpassword'];
        
        $check_password = mysqli_query($conn, "SELECT `password` FROM user WHERE `password` = '$Opassword'");

        if ($check_password->num_rows > 0) {

            $uppercase = preg_match('@[A-Z]@', $Npassword);
            $lowercase = preg_match('@[a-z]@', $Npassword);
            $number    = preg_match('@[0-9]@', $Npassword);
            $specialChars = preg_match('@[^\w]@', $Npassword);
        
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Npassword) < 8){
                echo $_SESSION['fail'] = "<span class='badge badge-pill badge-light-danger'>Password needs
                8 character, 1 number and 1 special characters</span>";
                header("location: ../../admin/admin-account-settings.php");
            } elseif($Npassword == $Rpassword){
                $sql = mysqli_query($conn, "UPDATE user SET `password` = '{$Npassword}' WHERE user_id=".$_SESSION['user_id']);
                echo $_SESSION['fail'] = '<span class="badge badge-pill badge-light-success">Password Successfully Update</span>';
                header("location: ../../admin/admin-account-settings.php");
            } elseif($Npassword != $Rpassword){
                echo $_SESSION['fail'] = '<span class="badge badge-pill badge-light-warning">Password Does not Match</span>';
                header("location: ../../admin/admin-account-settings.php");
            }
            
        }else{
            echo $_SESSION['fail'] = '<span class="badge badge-pill badge-light-danger">Old Password is incorrect</span>';
            header("location: ../../admin/admin-account-settings.php");
        }
    }
?>
        
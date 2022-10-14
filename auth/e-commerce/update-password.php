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
                echo $_SESSION['success'] = "<span class='badge badge-pill badge-light-danger'>Password needs
                8 character, 1 number and 1 special characters</span>";
                    header("location: ../../e-com/page-account-settings.php");
            } elseif($Npassword == $Rpassword){
                $sql = mysqli_query($conn, "UPDATE user SET `password` = '{$Npassword}' WHERE user_id=".$_SESSION['user_id']);
                $_SESSION['status_icon'] = "success";
                $_SESSION['status_title'] = "Password Changed!";
                $_SESSION['status_text'] = "You have successfully updated your password";  
                header("location: ../../e-com/page-account-settings.php");
            } elseif($Npassword != $Rpassword){
                echo $_SESSION['success'] = '<span class="badge badge-pill badge-light-success">Password Does not Match</span>';
                header("location: ../../e-com/page-account-settings.php");
            }
            
        }else{
            echo $_SESSION['success'] = '<span class="badge badge-pill badge-light-danger">Old Password is incorrect</span>';
            header("location: ../../e-com/page-account-settings.php");
        }
    }
?>
<!-- echo $_SESSION['failed'] = '
                <div class="alert alert-danger" role="alert">
					<h4 class="alert-heading">Error!!</h4>
					<div class="alert-body">
						Current Password is not Correct Please Try again.
					</div>
				</div>';
                header("location: ../../e-com/page-account-settings.php");
                echo $_SESSION['success'] = '<span class="badge badge-pill badge-light-success">Password Successfully change</span>';
                $sql = mysqli_query($conn, "UPDATE user SET `password` = '{$Npassword}' WHERE user_id=".$_SESSION['user_id']); -->
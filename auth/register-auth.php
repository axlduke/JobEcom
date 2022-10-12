<?php
session_start();
include "db.php";

	if(isset($_POST['users'])){

		$fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
		$contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
		$address = trim(mysqli_real_escape_string($conn, $_POST['address']));
		$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
		$password = trim(mysqli_real_escape_string($conn, $_POST['password']));
		$mode = trim(mysqli_real_escape_string($conn, $_POST['mode']));
		$gender = trim(mysqli_real_escape_string($conn, $_POST['gender']));
		$type = trim(mysqli_real_escape_string($conn, $_POST['type']));
		$location="../img/valid_info/";
        $front=$_FILES['front']['name'];
        $file_tmp1=$_FILES['front']['tmp_name'];
        $back=$_FILES['back']['name'];
        $file_tmp2=$_FILES['back']['tmp_name'];        

		$query =mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
		if(mysqli_num_rows($query) > 0){
	        echo '<script>window.alert("This email is already taken")</script>'; 
			echo "<script>window.history.go(-1);</script>";
		}
		else{

				$query_user = "INSERT INTO `user`(`fname`, `contact`, `email`, `gender`, `address`, `password`, `mode`, `front_id`, `back_id`, `type`) VALUES ('$fname','$contact','$email','$gender','$address','$password','$mode','$front','$back','$type')";
				if($conn->query($query_user) === TRUE){
					$sql = "SELECT * FROM user WHERE email = '$email' and `password`='$password'";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						$_SESSION['user_id'];
						$row = mysqli_fetch_array($result);
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['type'] = $row['type'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['mode'] = $row['mode'];
						$_SESSION['password'] = $row['password'];
						move_uploaded_file($file_tmp1, $location.$front);
						move_uploaded_file($file_tmp2, $location.$back);
				        $_SESSION['status_icon'] = "success";
				        $_SESSION['status_title'] = "Account Registered!";
				        $_SESSION['status_text'] = "Please wait for your account to be verified, we will email you once your account verification is done. Please note that you can not log in until your account is verified.";
							header("Location: ../form/login.php");
	
					}
				} else{
					echo '<script>window.alert("ERROR ON USERS!")</script>';
				}

		}
	}


    if (isset($_POST['seller'])) {
        $full_fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
        $contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $business_fname = trim(mysqli_real_escape_string($conn, $_POST['business']));
        $address = trim(mysqli_real_escape_string($conn, $_POST['address']));
        $type = trim(mysqli_real_escape_string($conn, $_POST['type']));
        $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
        $gender = trim(mysqli_real_escape_string($conn, $_POST['gender']));

		$location="../img/valid_info/";
        $front=$_FILES['front']['name'];
        $file_tmp1=$_FILES['front']['tmp_name'];
        $back=$_FILES['back']['name'];
        $file_tmp2=$_FILES['back']['tmp_name'];
        $bir=$_FILES['bir']['name'];
        $file_tmp3=$_FILES['bir']['tmp_name']; 

        // Check Email if taken
        $check = "SELECT email from user where email = '$email'";
        $run= mysqli_query($conn, $check);
        $select = mysqli_query($conn, "SELECT `email` FROM `user` WHERE `email` = '".$_POST['email']."' OR `contact` ='$contact'") or exit(mysqli_error($conn));
        if(mysqli_num_rows($select)) {
	        echo '<script>window.alert("This email is already taken")</script>'; 
			echo "<script>window.history.go(-1);</script>";
        exit();
        // Check Email End
    }

        $register = "INSERT INTO user (fname, contact, email,  business, gender, `address`, `password`, `front_id`,`back_id`,`bir`,`type`) VALUES ('$full_fname', '$contact', '$email', '$business_fname', '$gender', '$address', '$password','$front','$back','$bir','$type')";
        if (mysqli_query($conn, $register)) {
            $to_login = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
            $login = mysqli_query($conn, $to_login);

            if ($login->num_rows > 0) {
                $row = mysqli_fetch_array($login);
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['type'] = $row['type'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['permit'] = $row['permit'];
						$_SESSION['password'] = $row['password'];

						move_uploaded_file($file_tmp1, $location.$front);
						move_uploaded_file($file_tmp2, $location.$back);
						move_uploaded_file($file_tmp3, $location.$bir);
				        $_SESSION['status_icon'] = "success";
				        $_SESSION['status_title'] = "Account Registered!";
				        $_SESSION['status_text'] = "Please wait for your account to be verified, we will email you once your account verification is done";						
               header("Location: ../form/login.php");
            }
        } else {
            echo "Error: " . $register . "<br>" . mysqli_error($conn);
        }
    }


// FORM3 sign up
	if(isset($_POST['manager'])){

		$fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
		$contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
		$address = trim(mysqli_real_escape_string($conn, $_POST['address']));
		$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
		$password = trim(mysqli_real_escape_string($conn, $_POST['password']));
		$type = trim(mysqli_real_escape_string($conn, $_POST['type']));
		$company = trim(mysqli_real_escape_string($conn, $_POST['company']));
		$address = trim(mysqli_real_escape_string($conn, $_POST['address']));
		$gender = trim(mysqli_real_escape_string($conn, $_POST['gender']));

		$location="../img/valid_info/";
        $front=$_FILES['front']['name'];
        $file_tmp1=$_FILES['front']['tmp_name'];
        $back=$_FILES['back']['name'];
        $file_tmp2=$_FILES['back']['tmp_name'];
        $bir=$_FILES['bir']['name'];
        $file_tmp3=$_FILES['bir']['tmp_name'];        

		$query =mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
		if(mysqli_num_rows($query) > 0){
	        echo '<script>window.alert("This email is already taken")</script>'; 
			echo "<script>window.history.go(-1);</script>";
		}
		else{

				$query_user = "INSERT INTO `user`(`fname`, `contact`, `email`, `address`, `gender`, `password`, `front_id`,`back_id`,`bir`,`type`, `company`) VALUES ('$fname','$contact','$email','$address','$gender','$password','$front','$back','$bir','$type','$company')";
				if($conn->query($query_user) === TRUE){
					$sql = "SELECT * FROM user WHERE email = '$email' and password='$password'";
					$result = $conn->query($sql);
					if($result->num_rows > 0){
						$_SESSION['user_id'];
						$row = $result->fetch_array();
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['type'] = $row['type'];
						$_SESSION['password'] = $row['password'];
						move_uploaded_file($file_tmp1, $location.$front);
						move_uploaded_file($file_tmp2, $location.$back);
						move_uploaded_file($file_tmp3, $location.$bir);
				        $_SESSION['status_icon'] = "success";
				        $_SESSION['status_title'] = "Account Registered!";
				        $_SESSION['status_text'] = "Please wait for your account to be verified, we will email you once your account verification is done";						
						header("Location: ../form/login.php");
						// echo 'success';
					}
				} else{
					// echo 'fail';
					echo '<script>window.alert("ERROR ON USERS!")</script>';
					echo "<script>window.history.go(-1);</script>";
				}

		}
	}


// LOGIN


    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_now = date("Y-m-d");
        $check_email = "SELECT email FROM user WHERE email = '$email'";
        $result_email = mysqli_query($conn, $check_email);
        
        if ($result_email->num_rows > 0) {
            $get_email = mysqli_fetch_array($result_email);

            $check_user = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND verification_status = 'Verified'";
            $result_user = mysqli_query($conn, $check_user);
            
            if ($result_user->num_rows > 0) {          	
				$_SESSION['user_id'] = true;
                $row = $result_user->fetch_array();
				$_SESSION['user_id'] = $row['user_id'];
				$status = "Active now";
				$sql = mysqli_query($conn, "UPDATE user SET status = '{$status}' WHERE user_id=".$_SESSION['user_id']);  				
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['contact'] = $row['contact'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['mode'] = $row['mode'];
				$_SESSION['company'] = $row['company'];
				$_SESSION['ending_date'] = $row['ending_date'];				
                $row['user_id'] =$_SESSION['user_id'];
          		if ($row['restriction']=='Restricted') {
          			if ($date_now > $_SESSION['ending_date']) {
          				$sql = mysqli_query($conn, "UPDATE user SET restriction = '', starting_date='', ending_date=''  WHERE user_id=".$_SESSION['user_id']);  
          				if ($row['type'] == 0) {
	                        header("Refresh:0 url=../admin/dashboard-admin.php");
	                    }
	                    elseif ($row['type'] == 1) {
	                        header("Refresh:0 url=../user/user-job.php");
	                    }
	                    elseif ($row['type'] == 2) {
	                        header("Refresh:0 url=../e-com/dashboard-ecommerce.php");
	                    }                    
	                    elseif ($row['type'] == 3){
	                        header("Refresh:0; url=../job/dashboard-analytics.php");
	                	}  
          			}
          			else{
          			header("Refresh:0 url=restricted.php");
          			}
          		}elseif ($row['restriction']=='Banned') {
          			header("Refresh:0 url=banned.php");
          		}else{
          			    if ($row['type'] == 0) {
	                        header("Refresh:0 url=../admin/dashboard-admin.php");
	                    }
	                    elseif ($row['type'] == 1) {
	                        header("Refresh:0 url=../user/user-job.php");
	                    }
	                    elseif ($row['type'] == 2) {
	                        header("Refresh:0 url=../e-com/dashboard-ecommerce.php");
	                    }                    
	                    elseif ($row['type'] == 3){
	                        header("Refresh:0; url=../job/dashboard-analytics.php");
	                	}  
          		}           
            } else {

                echo $_SESSION['failed'] = '<div style="text-align:center;">
												<p class="badge badge-pill badge-light-warning">Make sure that your password is correct or<br>
																								your account may still not be verified.<br>
																								We will send an email to you once your<br>
																								account is verified.
											</div>';
                header("location: ../form/login.php");
            }
        } else {
            echo $_SESSION['failed'] = '<div style="text-align:center;">
											<p class="badge badge-pill badge-light-danger">Your Email is incorrect
											<br>Make sure you that your email is correct.</p>
										</div>';
				header("location: ../form/login.php");
        }
	}
?>

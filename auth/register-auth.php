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

		$query =mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
		if(mysqli_num_rows($query) > 0){
			echo '<script>window.alert("Email is already taken")</script>';
			echo "<script>window.history.go(-1);</script>";
		}
		else{

				$query_user = "INSERT INTO `user`(`fname`, `contact`, `email`, `address`, `password`, `mode`, `gender`, `type`) VALUES ('$fname','$contact','$email','$address','$password','$mode','$gender','$type')";
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
						
							header("Location: ../main.php");
	
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

        // Check Email if taken
        $check = "SELECT email from user where email = '$email'";
        $run= mysqli_query($conn, $check);
        $select = mysqli_query($conn, "SELECT `email` FROM `user` WHERE `email` = '".$_POST['email']."' OR `contact` ='$contact'") or exit(mysqli_error($conn));
        if(mysqli_num_rows($select)) {
			echo '<script>window.alert("Email is already taken")</script>';
			echo "<script>window.history.go(-1);</script>";
        exit();
        // Check Email End
    }

        $register = "INSERT INTO user (fname, contact, email,  business, `address`, `type`, `password`, gender) VALUES ('$full_fname', '$contact', '$email', '$business_fname',  '$address', '$type','$password','$gender')";
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

                
                header('location: ../admin-seller.php');
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

		$query =mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
		if(mysqli_num_rows($query) > 0){
			echo '<script>window.alert("Email is already taken")</script>';
			echo "<script>window.history.go(-1);</script>";
		}
		else{

				$query_user = "INSERT INTO `user`(`fname`, `contact`, `email`, `address`, `password`, `mode`, `gender`, `type`, `company`) VALUES ('$fname','$contact','$email','$address','$password','$mode','$gender','$type','$company')";
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
						header('Location: ../admin-jobs.php');
					}
				} else{
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

            $check_user = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
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

                echo $_SESSION['failed'] = '<div>
												<p class="badge badge-pill badge-light-warning">Make sure you know what is your password</p>
											</div>';
                header("location: ../form/login.php");
            }
        } else {
            echo $_SESSION['failed'] = '<div>
											<p class="badge badge-pill badge-light-danger">Email or Password</p>
											<p class="badge badge-pill badge-light-danger">Make sure you know what is your email or password</p>
										</div>';
				header("location: ../form/login.php");
        }
	}
?>

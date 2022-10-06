<?php
    
    // Include database connectivity
    session_start();
    include_once('db.php');
    $user_id =$_SESSION['user_id'];

    if (!empty($_FILES['image']['name'])) {
        $date = date('Y-m-d H:i:s');
        $fileName = $_FILES['image']['name'];
        
        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));
        $allowImg = array('png','jpeg','jpg');
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = '../img/'.$fileNew; 

    if (in_array($fileActExt, $allowImg)) {
        if ($_FILES['image']['size'] > 0  && $_FILES['image']['error']==0) {
        // $query = "INSERT INTO table_images (images) VALUES('$fileNew')";
                $query = "UPDATE user SET pictures = '$fileNew' WHERE user_id ='$user_id'";
            if ($conn->query($query)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
                 // '<img src="'.$filePath.'" style="width:320px; height:300px;"/>';
            
            }else{
            return false;
            }   
          }else{
            return false;
        }
    }else{  
            return false;
    }
    }

?>
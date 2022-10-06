<?php
    
    // Include database connectivity
//<-- send images--------------------------------------------------------------->
    session_start();
    include_once "../auth/db.php";
    $user_id =2;

    if (!empty($_FILES['image']['name'])) {
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        date_default_timezone_set('Asia/Manila');
        $fileName = $_FILES['image']['name'];
        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));
        $allowImg = array('png','jpeg','jpg','gif','raw','jfif','avi','mp4','mkv','mov','wmv','webm');
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = '../img/message/'.$fileNew; 
        if (in_array($fileActExt, $allowImg)) {
            if ($_FILES['image']['size'] > 0  && $_FILES['image']['error']==0) {
            // $query = "INSERT INTO table_images (images) VALUES('$fileNew')";
                    $query = ("INSERT INTO messages (incoming_message_id, outgoing_message_id, image, message, chat_date_time)
                                            VALUES ({$incoming_id}, {$outgoing_id}, '{$fileNew}', 'sent a photo.',CURRENT_TIMESTAMP)") or die();

                if ($conn->query($query)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
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

// <-- send files --------------------------------------------------------------->
    if (!empty($_FILES['file']['name'])) {
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $fileName = $_FILES['file']['name'];
        
        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));
        $allowImg = array('rar','pdf','doc','docx','html','htm','php','zip','zar','txt','xls','xlsx','ppt','mp3','m4a','wav','wma','m4r','ogg');
        // $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $fileNew = $fileName;
        $filePath = '../img/message/'.$fileNew;
        if (in_array($fileActExt, $allowImg)) {
            if ($_FILES['file']['size'] > 0  && $_FILES['file']['error']==0) {
            // $query = "INSERT INTO table_images (images) VALUES('$fileNew')";
                    $query = ("INSERT INTO messages (incoming_message_id, outgoing_message_id, files, message, chat_date_time)
                                            VALUES ({$incoming_id}, {$outgoing_id}, '{$fileNew}', 'sent a file.', CURRENT_TIMESTAMP)") or die();

                if ($conn->query($query)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
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
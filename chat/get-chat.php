<!-- <div class="user-chats"> -->
<div class="chats">                                         
<?php
    session_start();
    if(isset($_SESSION['user_id']))
    {
    include_once "../auth/db.php";
    $user_id = $_SESSION['user_id'];
    $delete = 'deleted';
    $output = "";
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $sql = "SELECT * FROM messages LEFT JOIN user ON user.user_id = messages.outgoing_message_id
    WHERE (outgoing_message_id = {$user_id} AND incoming_message_id = {$incoming_id})
    OR (outgoing_message_id = {$incoming_id} AND incoming_message_id = {$user_id}) ORDER BY message_id";
    $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                $files = $row['files'];
                if($row['outgoing_message_id'] === $user_id)
                { 
                    if (empty($row['image']) AND (empty($row['files']))) 
                    {
                    $output .= '                                        
                    <div class="chat">
                    <div class="chat-avatar">
                        <span class="avatar box-shadow-1 cursor-pointer">
                            <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                        </span>
                    </div>
                    <div class="chat-body">
                        <div class="chat-content">
                            <p style="max-width:300px">'.$row['message'].'</p>
                        </div>
                    </div>
                    </div>'; 
                    }
                    elseif (!empty($files)) 
                    {
                    $output .= '                                        
                    <div class="chat">
                    <div class="chat-avatar">
                        <span class="avatar box-shadow-1 cursor-pointer">
                            <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                        </span>
                    </div>
                    <div class="chat-body">
                        <div class="chat-content">
                            <p style="cursor: pointer;"><a style="color:white;" download href="../img/message/'.$files.'">'.$files.'</a></i></p>
                        </div>
                    </div>
                    </div>'; 
                    }
                    elseif (!empty($row['image']))
                    {
                    $output .= '                                        
                    <div class="chat">
                    <div class="chat-avatar">
                        <span class="avatar box-shadow-1 cursor-pointer">
                            <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                        </span>
                    </div>
                        <div class="chat-body">
                            <div class="chat-content">
                                <img class="img-fluid rounded mb-60" src="../img/message/'.$row['image'].'"/>
                            </div> 
                        </div> 
                    </div>'; 
                    }
                }
                else
                {
                    if (empty($row['image']) AND (empty($row['files']))) 
                    {
                        $output .='                                        
                         <div class="chat chat-left">
                            <div class="chat-avatar">
                                 <span class="avatar box-shadow-1 cursor-pointer">
                                    <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                                </span>
                            </div>
                            <div class="chat-body">
                                <div class="chat-content">
                                    <p style="max-width:300px">'.$row['message'].'</p>
                                </div>
                            </div>
                        </div> '; 
                    }
                    elseif(!empty($files)) 
                    {
                         $output .='                                        
                         <div class="chat chat-left">
                            <div class="chat-avatar">
                                 <span class="avatar box-shadow-1 cursor-pointer">
                                    <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                                </span>
                            </div>
                            <div class="chat-body">
                                <div class="chat-content">
                                    <p style="cursor: pointer;"><a style="color:white;" download href="../img/message/'.$files.'">'.$files.'</a></i></p>
                                </div>
                            </div>
                        </div> '; 
                    }
                    elseif(!empty($row['image'])) 
                    {
                         $output .='                                        
                         <div class="chat chat-left">
                            <div class="chat-avatar">
                                 <span class="avatar box-shadow-1 cursor-pointer">
                                    <img src="../img/profile/'.$row['pictures'].'" alt="avatar" height="36" width="36" />
                                </span>
                            </div>
                                <div class="chat-body">
                                    <div class="chat-content">
                                        <img class="img-fluid rounded mb-60" src="../img/message/'.$row['image'].'" />
                                    </div> 
                                </div> 
                        </div> '; 
                    }

                }   
            }     
            echo $output;                                                 
        }
    }
    else
    {
        header("location: ../login.php");
    }
?>  
</div>
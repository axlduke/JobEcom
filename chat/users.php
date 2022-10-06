<?php
                    
  session_start();
  include_once "../auth/db.php";
  if(!isset($_SESSION['user_id'])){
    header("location: ../login.php");
  }
      $outgoing_id = $_SESSION['user_id'];
    $sql_query = "SELECT * FROM user WHERE user_id ='$outgoing_id'";
    $result = $conn->query($sql_query);
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $type = $row['type'];
        $fname = $row['fname'];
        $contact = $row['contact'];
        $mode = $row['mode'];
        $pictures = $row['pictures'];
        require_once('../auth/db.php');
    } 

    $sql = "SELECT m.* ,u.* from messages m inner join ( select max(message_id) as maxid from messages where messages.outgoing_message_id =$outgoing_id OR messages.incoming_message_id = $outgoing_id group By (if(outgoing_message_id > incoming_message_id, outgoing_message_id, incoming_message_id)) , (if(outgoing_message_id > incoming_message_id, incoming_message_id, outgoing_message_id)) ) t1 on m.message_id=t1.maxid join user u ON u.user_id = (CASE WHEN m.outgoing_message_id = $outgoing_id THEN m.incoming_message_id ELSE m.outgoing_message_id END) ORDER by message_id desc";
        $query = mysqli_query($conn, $sql);

        $output = "";
        if(mysqli_num_rows($query) == 0){

            echo "<p style='text-align:center;'>  You have no conversation yet.</p>";
                                        
        }elseif(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $timestamp = $row['chat_date_time'];
                $currentDateTime = '08/04/2010 22:15:00';
                $time = date('h:i A', strtotime($timestamp));
                 $sql2 = "SELECT * FROM messages WHERE (incoming_message_id = {$row['user_id']}
                         OR outgoing_message_id = {$row['user_id']}) AND (outgoing_message_id = {$outgoing_id} 
                         OR incoming_message_id = {$outgoing_id})  ORDER BY message_id DESC LIMIT 1";  

                $query2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($query2);
                (mysqli_num_rows($query2) > 0) ? $result = $row2['message'] : $result ="No message available";
                (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
                if(isset($row2['outgoing_message_id'])){
                     ($outgoing_id == $row2['outgoing_message_id']) ? $you = "You: " : $you = "";
                }else{
                    $you = "";
                }
                ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
                ($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";
                if ($row['status']== "Offline now") {
                   $status = '<span class="avatar-status-offline"></span>';
                }
                if ($row['status']== "Active now") {
                    $status = '<span class="avatar-status-online"></span>';
                }
                $output .= '                                             
                        <a class="ajaxLink" href="app-chat.php?incoming_id='.$row['user_id'].'">
                        <ul class="chat-users-list chat-list media-list">
                            <li>
                                <span class="avatar"><img src="../img/profile/'.$row['pictures'].'" height="42" width="42"/>
                                    '.$status.'
                                </span>
                                <div class="chat-info flex-grow-1">
                                    <h5 class="mb-0">'.$row['fname'].'</h5>
                                    <p class="card-text text-truncate">
                                        '.$row['message'].'
                                    </p>
                                </div>
                                <div class="chat-meta text-nowrap">
                                    <small class="float-right mb-25 chat-time">'.$time.'</small>
                                    <span class="badge badge-danger badge-pill float-right"></span>
                                </div>
                            </li>
                        </ul></a>
                                                               
                        '
                        ;
                }
            echo $output;
                                        
    } ?>
                                                                    <!-- <li class="no-results">
                                                                        <h6 class="mb-0">No Contacts Found</h6>
                                                                    </li> -->                                        
<!--                             <script>
                                  $('.ajaxLink').click(function(e){
                              e.preventDefault(); // Prevents default link action
                              $.ajax({
                                 url: $(this).attr('href'),
                                 success: function(data){
                                   // Do something
                                 }
                              });
                            });
                            </script> -->
                             
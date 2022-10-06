<?php

    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_message_id = {$row['user_id']}
                OR outgoing_message_id = {$row['user_id']}) AND (outgoing_message_id = {$outgoing_id} 
                OR incoming_message_id = {$outgoing_id})  ORDER BY message_id DESC LIMIT 1";

        // $sql2 = "SELECT * from messages where outgoing_message_id=( select f.user_id from user f where f.user_id=1) or incoming_message_id=( select f.user_id from user f where f.user_id=1) group by message_id order by message_id desc";        

        
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
        $output .= '    <a class="ajaxLink" href="app-chat.php?incoming_id='.$row['user_id'].'">
                        <ul class="chat-users-list chat-list media-list">
                            <li>
                                <span class="avatar"><img src="../img/profile/'.$row['pictures'].'" height="42" width="42" />
                                    '.$status.'
                                </span>
                                <div class="chat-info flex-grow-1">
                                    <h5 class="mb-0">'.$row['fname'].'</h5>
                                    <p class="card-text text-truncate">
                                        '.$you.$msg.'
                                    </p>
                                </div>
                                <div class="chat-meta text-nowrap">
                                    <small class="float-right mb-25 chat-time">4:14 PM</small>
                                    <span class="badge badge-danger badge-pill float-right">3</span>
                                </div>
                            </li>
                        </ul></a>
                                                               
                        '
                        ;;
        }

?>
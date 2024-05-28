<?php
    // Loop through each row fetched from the database
    while($row = mysqli_fetch_assoc($query)){
        
        // Select the latest message related to the current user from the messages table
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        
        // Execute the query
        $query2 = mysqli_query($conn, $sql2);
        
        // Fetch the row from the result set
        $row2 = mysqli_fetch_assoc($query2);
        
        // Check if there are any messages
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        
        // Truncate long messages to fit within a certain length
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        
        // Check if the message is outgoing or incoming, and set "You" accordingly
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        
        // Check if the user is offline and set the appropriate CSS class
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        
        // Check if the current user is the sender, and hide their own messages
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        // Construct HTML output for each user with their details and latest message
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>

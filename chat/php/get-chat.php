<?php 
    // Start a new session or resume the existing session
    session_start();

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['unique_id'])){
        // Include the configuration file for database connection
        include_once "config.php";

        // Get the unique ID of the logged-in user from the session
        $outgoing_id = $_SESSION['unique_id'];

        // Escape special characters in the incoming user ID to prevent SQL injection
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

        // Initialize the output variable
        $output = "";

        // SQL query to fetch messages between the logged-in user and the selected user, ordered by message ID
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

        // Execute the query
        $query = mysqli_query($conn, $sql);

        // Check if the query returned any results
        if(mysqli_num_rows($query) > 0){
            // Loop through each row in the result set
            while($row = mysqli_fetch_assoc($query)){
                // Check if the message is outgoing
                if($row['outgoing_msg_id'] === $outgoing_id){
                    // Format and append the outgoing message HTML to the output variable
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                } else {
                    // Format and append the incoming message HTML with user image to the output variable
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        } else {
            // If no messages are found, append a placeholder message to the output variable
            $output .= '<div class="text">No messages are available. Once you send a message they will appear here.</div>';
        }

        // Output the final result
        echo $output;
    } else {
        // If the user is not logged in, redirect to the login page
        header("location: ../login.php");
    }
?>

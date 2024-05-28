<?php 
    // Start a new session or resume the existing session
    session_start();

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['unique_id'])){
        // Include the configuration file for database connection
        include_once "config.php";

        // Get the unique ID of the logged-in user from the session
        $outgoing_id = $_SESSION['unique_id'];

        // Escape special characters in the incoming user ID and message to prevent SQL injection
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Check if the message is not empty
        if(!empty($message)){
            // Insert the message into the messages table
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(mysqli_error($conn));
        }
    } else {
        // If the user is not logged in, redirect to the login page
        header("location: ../login.php");
    }
?>

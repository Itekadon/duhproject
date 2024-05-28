<?php
    // Start a new session or resume the existing session
    session_start();

    // Check if the user is logged in by verifying the session variable
    if(isset($_SESSION['unique_id'])){
        // Include the configuration file for database connection
        include_once "config.php";

        // Escape special characters in the logout ID to prevent SQL injection
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        // Check if the logout ID is set
        if(isset($logout_id)){
            // Set the user status to "Offline now"
            $status = "Offline now";
            // Update the user status in the database
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
            if($sql){
                // Unset all session variables
                session_unset();
                // Destroy the session
                session_destroy();
                // Redirect to the login page
                header("location: ../login.php");
            }
        } else {
            // If the logout ID is not set, redirect to the users page
            header("location: ../users.php");
        }
    } else {  
        // If the user is not logged in, redirect to the login page
        header("location: ../login.php");
    }
?>

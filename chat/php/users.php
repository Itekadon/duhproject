<?php
    // Start a new session or resume the existing session
    session_start();

    // Include the configuration file for database connection
    include_once "config.php";

    // Get the unique ID of the logged-in user from the session
    $outgoing_id = $_SESSION['unique_id'];

    // Query the database for users excluding the logged-in user, ordered by user ID in descending order
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);

    // Initialize the output variable
    $output = "";

    // Check if the query returned any results
    if(mysqli_num_rows($query) == 0){
        // If no users are found, append a message to the output variable
        $output .= "No users are available to chat";
    } elseif(mysqli_num_rows($query) > 0){
        // If users are found, include the data.php file to process and display the user data
        include_once "data.php";
    }

    // Output the final result
    echo $output;
?>

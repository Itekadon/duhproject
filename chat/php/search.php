<?php
    // Start a new session or resume the existing session
    session_start();

    // Include the configuration file for database connection
    include_once "config.php";

    // Get the unique ID of the logged-in user from the session
    $outgoing_id = $_SESSION['unique_id'];

    // Escape special characters in the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // SQL query to find users whose first name or last name matches the search term, excluding the logged-in user
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";

    // Initialize the output variable
    $output = "";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query returned any results
    if(mysqli_num_rows($query) > 0){
        // If users are found, include the data.php file to process and display the user data
        include_once "data.php";
    } else {
        // If no users are found, append a message to the output variable
        $output .= 'No user found related to your search term';
    }

    // Output the final result
    echo $output;
?>

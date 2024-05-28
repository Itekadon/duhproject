<?php 
    // Start a new session or resume the existing session
    session_start();

    // Include the configuration file for database connection
    include_once "config.php";

    // Escape special characters in the email and password to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if both email and password fields are not empty
    if(!empty($email) && !empty($password)){
        // Query the database for the email provided
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

        // Check if the query returned any results
        if(mysqli_num_rows($sql) > 0){
            // Fetch the user data as an associative array
            $row = mysqli_fetch_assoc($sql);

            // Encrypt the provided password using md5
            $user_pass = md5($password);
            // Get the encrypted password from the database
            $enc_pass = $row['password'];

            // Compare the encrypted password with the stored encrypted password
            if($user_pass === $enc_pass){
                // Set the user status to "Active now"
                $status = "Active now";
                // Update the user status in the database
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    // Set the session with the unique ID of the logged-in user
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is Incorrect!";
            }
        } else {
            echo "$email - This email does not exist!";
        }
    } else {
        echo "All input fields are required!";
    }
?>

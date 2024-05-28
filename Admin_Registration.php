
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
  <link rel="stylesheet" href="home.css">
  <link rel="icon" type="image/jpeg" href="./logo.jpeg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./home_animations.css">

    
  </head>

<header class =  " container "> 
    <div class = "ccontainer" >
        <div class = "website-name">
            <h1>DadsUnityHub</h1>
        </div>
        <div class="navigation-links">
            <nav>
                 <ul>
                    <!-- <li><a href="home.html">Home</a></li> -->
                     <!-- <li><a href="http://127.0.0.1:5500/home.html">About Us!</a></li> -->
                    <!-- <li><a href="login.html">Login</a></li> -->
                    <!-- <li><a href="Testimonials.html">Testimonials</a></li>
                    <li><a href="books.html">Resources</a></li> -->
                    <!--
                    <li><a href="login.html" class="button" style="color: white;"> Login </a></li>
                    <li><a href="login.html" class="button" style="color: whitesmoke;">Join</a></li>
                    -->

                    <!--OLD FORM LINKS-->
                    <!-- <li><a href="login2.php" class="button" style="color: whitesmoke;">Login</a></li>
                    <li><a href="signUp.php" class="button" style="color: whitesmoke;">Sign Up</a></li> -->
                </ul> 
            </nav>
            
        </div>
      </div>
         
 
</header>

<body>
    <h2>Admin Registration</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register" name="register">
    </form>
</body>

</html>


<?php
// Start the session
session_start();

// Include database connection file
include_once 'db_connection.php';

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert new admin into database
    $sql = "INSERT INTO admin (username, password_hash) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['message'] = "Registration successful. You can now login.";
        header("Location: Admin_login.php");
        exit();
    } else {
        // Registration failed
        $_SESSION['error'] = "Registration failed. Please try again later.";
        header("Location: Admin_Registration.php");
        exit();
    }
}
?>







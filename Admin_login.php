<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="newsignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="signIn.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name"><a href="#">
                <!-- Dads Unit Hub -->
                <label for="checkbox">
                    <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
                </label><br><br></a>
        </h2>
        <h1 style="font-size: 50px; text-align: center;">Dads Unity Hub</h1>
        <div class="icon-container">
            <a href="login1.php"><i class="fas fa-user-plus"></i>User login</a>

            </li>
        </div>
    </header>
    <div class="body">


        <nav class="side-bar">
            <div class="user-p">
                <img src="IMAGES 2/Father and children.jpeg">
                <h4>Dads Unit Hub</h4>
            </div>
            <ul>
                <li>
                    <a href="home.html">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="signUp.php">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>Sign up</span>
                    </a>
                </li>
                <li>
                    <a href="login1.php">
                        <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                        <span>User Login</span>
                    </a>
                </li>

                <li>
                    <a href="home.html">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>Contact Us</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="section-1" style="background-image: url(./Images/Father\ and\ son\ at\ the\ beach.jpeg);">
            <!-- <p>#Dads Unit Hub</p> -->
            <div class="login">
                <form method="POST" action="Admin_login.php">
                    <h1 style="font-size:50px;">ADMIN LOG IN</h1>
                    <label>Username</label>
                    <input type="text" id="username" name="username" required>
                    <label>Password</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </section>
    </div>

</body>

</html
<?php

session_start();

// connect to the database
include_once 'db_connection.php';

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // get password from the saved username
    $sql = "SELECT username, password_hash FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // whenadmin is found verify the password
        $stmt->bind_result($db_username, $db_password_hash);
        $stmt->fetch();
        if (password_verify($password, $db_password_hash)) {
            // if password checks out, redirect to the dashboard or admin page
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_logged_in'] = true;
            header("Location:dashboard.php");
            exit();
        } else {
            // if password does not match
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: Admin_login.php");
            exit();
        }
    } else {
        // Admin not found
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: Admin_login.php");
        exit();
    }
}
?>



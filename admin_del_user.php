<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: Admin_login.php");
    exit;
}

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM user_profiles WHERE user_id = ?");
    $stmt->bind_param("s", $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
} else {
    echo "Invalid user ID.";
}

$conn->close();
header("Location: user_management.php");
exit;
?>



<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
         <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="admin_usermgnmt.css">

</head>
<body>

   <header>
       
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                
            </ul>
        </nav>
    </header>



    
</body>
</html>

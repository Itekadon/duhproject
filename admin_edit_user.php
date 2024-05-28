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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_POST['user_name'];
        $Firstname = $_POST['first_name'];
    

        // Prepare and execute the update query
        $stmt = $conn->prepare("UPDATE user_profiles SET user_name = ?, first_name = ?  WHERE user_id = ?");
        $stmt->bind_param("sss", $userName, $Firstname, $userId);

        // if ($stmt->execute()) {
        //     echo "User updated successfully.";
        // } else {
        //     echo "Error updating user.";
        // }

   if ($stmt->execute()) {
            $_SESSION['edit_message'] = "User updated successfully.";
        } else {
            $_SESSION['edit_message'] = "Error updating user.";
        }

        $stmt->close();
        header("Location: user_management.php");
        exit;
    }

    // Fetch current user details
    $stmt = $conn->prepare("SELECT * FROM user_profiles WHERE user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid user ID.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="home.css">
    <!-- <link rel="stylesheet" href="admin_edit.css"> -->
</head>
<body>
    
 <header>
       
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                
            </ul>
        </nav>
    </header>

        
    
    <h1>Edit User</h1>
    <form method="post" action="">
        Username: <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>" required><br>
        Firstname: <input type="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>
    
        <input type="submit" value="Update">
    </form>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
         <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="admin_usermgnmt.css">

</head>
<body>

  
    
</body>
</html>
<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (!isset($user_data['user_id'])) {
    // Redirect user to login page or display an error message
    header("Location: home.html");
    exit; // Stop further execution
}

// Check if the form is submitted for deletion
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $user_data['user_id'];
    
    // Delete the user's profile
    $query = "DELETE FROM user_profiles WHERE user_id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        // Check if the profile was deleted successfully
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $delete_message = "Profile removed successfully.";
        } else {
            $delete_error = "Failed to delete profile!";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        $delete_error = "Database query failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Profile</title>
</head>
<body>
  <div class="container">
    <h2>Delete Profile</h2>
    <?php if (isset($delete_message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($delete_message); ?></p>
    <?php elseif (isset($delete_error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($delete_error); ?></p>
    <?php endif; ?>
    <p>Are you sure you want to delete your profile?</p>
    <form method="post">
      <button type="submit">Delete</button>
    </form>
  </div>
</body>
</html>

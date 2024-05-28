<?php 
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (!isset($user_data['user_id'])) {
    // Redirect user to login page or display an error message
    header("Location: login2.php");
    exit; // Stop further execution
}

// Retrieve user information from the database
$user_id = $user_data['user_id'];
$query = "SELECT * FROM user_profiles WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$user_info = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $biography = $_POST['biography'];

    // Check if a new profile picture has been uploaded
    if ($_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $profile_picture = $_FILES['profile_picture']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_picture);

        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
    } else {
        // No new picture uploaded, keep the existing one
        $profile_picture = $user_info['profile_picture'];
    }

    // Update user information in the database
    $update_query = "UPDATE user_profiles SET first_name=?, last_name=?, user_name=?, age=?, gender=?, location=?, biography=?, profile_picture=? WHERE user_id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "sssissssi", $first_name, $last_name, $user_name, $age, $gender, $location, $biography, $profile_picture, $user_id);
    mysqli_stmt_execute($stmt);

    // Redirect to profile page after updating
    header("Location: profile1.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
</head>
<style>
    /* profile.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header.container {
    background-color: #333;
    color: #fff;
    padding: 1em;
    text-align: center;
}

.member-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.profile-box {
    background-color: #fff;
    padding: 2em;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
}

.profile-box h2 {
    margin-top: 0;
    color: #333;
}

.profile-box form label {
    display: block;
    margin-top: 1em;
    color: #333;
}

.profile-box form input[type="text"],
.profile-box form input[type="number"],
.profile-box form select,
.profile-box form textarea,
.profile-box form input[type="file"] {
    width: 100%;
    padding: 0.5em;
    margin-top: 0.5em;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.profile-box form textarea {
    resize: vertical;
}

.profile-box form button[type="submit"] {
    display: block;
    width: 100%;
    padding: 1em;
    margin-top: 1em;
    border: none;
    background-color: #5cb85c;
    color: #fff;
    font-size: 1em;
    border-radius: 4px;
    cursor: pointer;
}

.profile-box form button[type="submit"]:hover {
    background-color: #4cae4c;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1em;
    position: fixed;
    bottom: 0;
    width: 100%;
}

</style>
<body>

<header class="container"> 
    <!-- Header content here -->
</header>

<div class="member-container" style="height:1cm;margin-top:12cm;">
  <div class="profile-box">
      <h2>Edit Profile</h2>
      <form method="post" action="edit_profileF.php" enctype="multipart/form-data">
          <label for="first_name">First Name:</label><br>
          <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user_info['first_name']); ?>"><br>

          <label for="last_name">Last Name:</label><br>
          <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user_info['last_name']); ?>"><br>

          <label for="user_name">Username:</label><br>
          <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user_info['user_name']); ?>"><br>

          <label for="age">Age:</label><br>
          <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user_info['age']); ?>"><br>

          <label for="gender">Gender:</label><br>
          <select id="gender" name="gender">
              <option value="Male" <?php if ($user_info['gender'] == 'Male') echo 'selected'; ?>>Male</option>
              <option value="Female" <?php if ($user_info['gender'] == 'Female') echo 'selected'; ?>>Female</option>
          </select><br>

          <label for="location">Location:</label><br>
          <select id="location" name="location">
              <option value="Eastern Cape" <?php if ($user_info['location'] == 'Eastern Cape') echo 'selected'; ?>>Eastern Cape</option>
              <option value="Free State" <?php if ($user_info['location'] == 'Free State') echo 'selected'; ?>>Free State</option>
              <option value="Gauteng" <?php if ($user_info['location'] == 'Gauteng') echo 'selected'; ?>>Gauteng</option>
              <option value="KwaZulu-Natal" <?php if ($user_info['location'] == 'KwaZulu-Natal') echo 'selected'; ?>>KwaZulu-Natal</option>
              <option value="Limpopo" <?php if ($user_info['location'] == 'Limpopo') echo 'selected'; ?>>Limpopo</option>
              <option value="Mpumalanga" <?php if ($user_info['location'] == 'Mpumalanga') echo 'selected'; ?>>Mpumalanga</option>
              <option value="North West" <?php if ($user_info['location'] == 'North West') echo 'selected'; ?>>North West</option>
              <option value="Northern Cape" <?php if ($user_info['location'] == 'Northern Cape') echo 'selected'; ?>>Northern Cape</option>
              <option value="Western Cape" <?php if ($user_info['location'] == 'Western Cape') echo 'selected'; ?>>Western Cape</option>
          </select><br>
          
          <label for="biography">Biography:</label><br>
          <textarea id="biography" name="biography"><?php echo htmlspecialchars($user_info['biography']); ?></textarea><br>

          <label for="profile_picture">Profile Picture:</label><br>
          <input type="file" id="profile_picture" name="profile_picture"><br>

          <button type="submit" style="background-color:#262931;">Save Changes</button>
      </form>
  </div>
</div>

</body>
</html>

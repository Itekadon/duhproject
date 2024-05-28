<?php
session_start();

// Include database connection and functions
include("connection.php");
include("functions.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit;
}

// Get the member ID from the URL
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Retrieve the member's information from the database
    $query = "SELECT * FROM user_profiles WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    // Retrieve member's uploaded photos
    $photo_query = "SELECT file_name FROM user_profiles WHERE user_id = ? AND file_type LIKE 'image/%'";
    $photos = [];
    $stmt = $con->prepare($photo_query);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $photo_result = $stmt->get_result();
    while ($row = $photo_result->fetch_assoc()) {
        $photos[] = $row['file_name'];
    }

    // Retrieve member's uploaded videos
    $video_query = "SELECT file_name, file_type FROM user_profiles WHERE user_id = ? AND file_type LIKE 'video/%'";
    $videos = [];
    $stmt = $con->prepare($video_query);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $video_result = $stmt->get_result();
    while ($row = $video_result->fetch_assoc()) {
        $videos[] = ['file_name' => $row['file_name'], 'file_type' => $row['file_type']];
    }
} else {
    echo "Member ID not specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Member Profile</title>
    <link rel="stylesheet" href="no_pic.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        nav {
  width: 80%;
  margin: 0 auto;
  text-align: center;
}

nav ul {
  list-style-type: none;
}

nav ul li {
  display: inline;
  margin-right: 20px;
}
/* Navigation Styles */
.navigation-links a {
  text-decoration: none;
  font-size: 18pt;
  color: darkblue;
  font-weight: bold;
  position: relative; /* Ensure positioning context */
  transition: transform 0.3s ease-in-out, z-index 0.3s ease-in-out; /* Add smooth transition */
  z-index: 1; /* Ensure links are above other content */

  background-color: none;
}

/* Add pop-up effect on hover */
.navigation-links a:hover {
  transform: translateY(-5px); /* Move the link upward */
  z-index: 2; /* Increase z-index to bring link forward */
}
     </style>
</head>
<body>
    <header class="container">
        <div class="website-name">
            <h1 style="color:darkblue;font-size:1.5cm;">DadsUnityHub</h1>
        </div>
        <div class="navigation-links">
            <nav>
                <ul>
                    <li><a href="profile1.php">Profile</a></li>
                    <li><a href="discussion.php">Discussion Forum</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="profile-container" style="border:1px solid powderblue;margin-top:1cm;">
        <h2>Member Profile:  <?php echo htmlspecialchars($member['user_name']); ?></h2>
        <div class="profile-details">
            <?php if (!empty($member['profile_picture'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($member['profile_picture']); ?>" alt="Profile Picture">
            <?php else: ?>
                <div class="default-profile-picture">
                    <i class="fas fa-user-circle"></i>
                </div>
            <?php endif; ?>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($member['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($member['last_name']); ?></p>
            <p><strong>User Name:</strong> <?php echo htmlspecialchars($member['user_name']); ?></p>
            <p><strong>Biography:</strong> <?php echo nl2br(htmlspecialchars($member['biography'])); ?></p>
        </div>
        </div>
    </div>
</body>
</html>

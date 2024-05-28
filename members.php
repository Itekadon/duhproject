<?php
session_start();
include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit;
}

$query = "SELECT id, first_name, last_name,age, profile_picture FROM user_profiles";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members</title>
    
    <link rel="stylesheet" href="members.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="no_pic.css"> 
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
  color: #262931;
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
<body style="background-color:whitesmoke;">
    <header class="container">
        <div class="website-name">
            <h1 style="color:#262931;font-size:1.5cm;">DadsUnityHub</h1>
        </div>
        <div class="navigation-links">
            <nav>
                <ul>
                    <li><a href="./chat/index.php">Live chat</a></li>
                    <li><a href="profile1.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="members-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <a href="view_profile.php?id=<?php echo $row['id']; ?>" class="member-container">
                <?php if (!empty($row['profile_picture'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture">
                <?php else: ?>
                    <div class="default-profile-picture">
                    <i class="fas fa-user-circle"></i>
                </div>
                <?php endif; ?>
                <div class="member-info">
                    
                    <p class="name"><?php echo htmlspecialchars($row['first_name']); ?>
                     <?php echo htmlspecialchars($row['last_name']); ?></p>
                     <p class="age"><?php echo htmlspecialchars($row['age']); ?></p>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</body>
</html>

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

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] == 0) {
        $file_name = basename($_FILES['file']['name']);
        $file_type = $_FILES['file']['type'];
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;

        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // Save file info to the database
            $query = "INSERT INTO user_profiles (user_id, file_name, file_type) VALUES (?, ?, ?)
                      ON DUPLICATE KEY UPDATE file_name = VALUES(file_name), file_type = VALUES(file_type)";
            if ($stmt = mysqli_prepare($con, $query)) {
                mysqli_stmt_bind_param($stmt, "iss", $user_id, $file_name, $file_type); 
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                // Redirect to avoid form resubmission
                header("Location: profile1.php");
                exit;
            } else {
                $upload_error = "Database query failed!";
            }
        } else {
            $upload_error = "Failed to upload file!";
        }
    } else {
        $upload_error = "No file uploaded or upload error!";
    }
}

// Retrieve the user's profile picture
$pic_query = "SELECT file_name FROM user_profiles WHERE user_id = '$user_id'";
$pic_result = mysqli_query($con, $pic_query);
$pic_info = mysqli_fetch_assoc($pic_result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="tempprofile.css">
</head>

<body>

    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">
            <a href="#">
                <label for="checkbox">
                    <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
                </label><br><br>
            </a>
        </h2>
        <h1 style="font-size: 50px; text-align: center;">Dads Unity Hub</h1>
        
        <div class="icon-container">
            <a href="logout.php"><i class="fas fa-user-plus"></i> Logout</a><br>
        </div>
    </header>

    <div class="main-container">
        <nav class="side-bar">
            <div class="user-p">
                <img src="IMAGES 2/Father and children.jpeg">
                <h4>Dads Unit Hub</h4>
            </div>
            <ul>
                <li><a href="home.html"><i class="fa fa-home" aria-hidden="true"></i> <span>Home</span></a></li>
                <li><a href="members.php"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Members</span></a></li>
                <li><a href="./comment/index.php"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> <span>Discussion Forum</span></a></li>
                <li><a href="./project calls/payment.html"><i class="fa fa-info-circle" aria-hidden="true"></i> <span>Subscription</span></a></li>
                <li><a href="delete_profile.php"><i class="fa fa-book" aria-hidden="true"></i> <span>Delete profile</span></a></li>
                <li><a href="edit_profileF.php"><i class="fa fa-book" aria-hidden="true"></i> <span>Edit profile</span></a></li>
                <li><a href="resources.html"><i class="fa fa-book" aria-hidden="true"></i> <span>Resources</span></a></li>
            </ul>
        </nav>
        <section class="member-container">
            <div class="profile-box">
                <h2>Member Profile</h2>
                    <p><img class="profile-picture" src="uploads/<?php echo htmlspecialchars($user_info['profile_picture']); ?>" alt="Profile Picture"></p>
                    <div class="profile-info">
                        <p><?php echo htmlspecialchars($user_info['first_name']); ?> <?php echo htmlspecialchars($user_info['last_name']); ?>: <?php echo htmlspecialchars($user_info['age']); ?></p>
                        <p><?php echo htmlspecialchars($user_info['user_name']); ?></p>
                    </div>

                    <div id="moreContent"> 
                        <div class="more_information">
                            <p><strong>Gender  : </strong> <?php echo htmlspecialchars($user_info['gender']); ?></p>
                            <p><strong> Location: </strong><?php echo htmlspecialchars($user_info['location']); ?></p>
                            <p><strong>About me</strong><br><?php echo htmlspecialchars($user_info['biography']); ?></p><br>
                        </div>
                    </div>
                    
                    <button class="show-more-button" onclick="showMore()">Show More</button><br>
                        <!-- File Upload Section -->

                <div class="upload-box">
                    <h4>Upload Photos and Videos</h4>
                    <?php if (isset($upload_error)): ?>
                        <p style="color: red;"><?php echo htmlspecialchars($upload_error); ?></p>
                    <?php endif; ?>
                    <form action="profile1.php" method="post" enctype="multipart/form-data" action="submit">
                        <input type="file" name="file" accept="image/*,video/*" required><br>
                        <button type="submit">Upload</button>
                    </form>
                </div>

                </div>
            <div class="photo-box">
                <h3>My Photos</h3>
                <?php
                $query = "SELECT * FROM user_profiles WHERE user_id = ? AND file_type LIKE 'image/%'";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $file_path = 'uploads/' . htmlspecialchars($row['file_name']);
                            echo "<img src='$file_path' width='200'><br>";
                        }
                    } else {
                        echo "No photos yet.";
                    }

                    mysqli_stmt_close($stmt);
                } 
                ?> 
            </div>
            <div class="video-box">
                <h3>My Videos</h3>
                <?php
                $query = "SELECT * FROM user_profiles WHERE user_id = ? AND file_type LIKE 'video/%'";
                if ($stmt = mysqli_prepare($con, $query)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $file_path = 'uploads/' . htmlspecialchars($row['file_name']);
                            echo "<video width='320' height='240' controls>
                                    <source src='$file_path' type='" . htmlspecialchars($row['file_type']) . "'>
                                    </video><br>";
                        }
                    } else {
                        echo "No videos yet.";
                    }

                    mysqli_stmt_close($stmt);
                }
                ?> 
            </div>
        </section>
    </div>

    <script src="join.js"></script>
    <script src="home.js"></script>
</body>
<footer >

    <p style="margin-top:1cm;color:#262931;margin-left:50%;margin-left:50%;">&copy; 2024 DadsUnityHub.co.za All Rights Reserved </p>
</footer>

</html>
<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: Admin_login.php");
    exit;
}

// // Display any message set in the session
// if (isset($_SESSION['message'])) {
//     echo "<p>" . $_SESSION['message'] . "</p>";
//     unset($_SESSION['message']); // Clear the message after displaying it
// }


// Fetch all users
$sql = "SELECT * FROM user_profiles";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    
        <link rel="stylesheet" href="admin_usermgnmt.css">
        <style>
  .btn-53,
.btn-53 *,
.btn-53 :after,
.btn-53 :before,
.btn-53:after,
.btn-53:before {
  border: 0 solid;
  box-sizing: border-box;
}

.btn-53 {
  -webkit-tap-highlight-color: transparent;
  -webkit-appearance: button;
  background-color: #000;
  background-image: none;
  color: #fff;
  cursor: pointer;
  font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
    Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif,
    Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
  font-size: 100%;
  line-height: 1.5;
  margin: 0;
  -webkit-mask-image: -webkit-radial-gradient(#000, #fff);
  padding: 0;
}

.btn-53:disabled {
  cursor: default;
}

.btn-53:-moz-focusring {
  outline: auto;
}

.btn-53 svg {
  display: block;
  vertical-align: middle;
}

.btn-53 [hidden] {
  display: none;
}

.btn-53 {
  border: 1px solid;
  border-radius: 999px;
  box-sizing: border-box;
  display: block;
  font-weight: 900;
  overflow: hidden;
  padding: 1.2rem 3rem;
  position: relative;
  text-transform: uppercase;
}

.btn-53 .original {
  background: #fff;
  color: #000;
  display: grid;
  inset: 0;
  place-content: center;
  position: absolute;
  transition: transform 0.2s cubic-bezier(0.87, 0, 0.13, 1);
}

.btn-53:hover .original {
  transform: translateY(100%);
}

.btn-53 .letters {
  display: inline-flex;
}

.btn-53 span {
  opacity: 0;
  transform: translateY(-15px);
  transition: transform 0.2s cubic-bezier(0.87, 0, 0.13, 1), opacity 0.2s;
}

.btn-53 span:nth-child(2n) {
  transform: translateY(15px);
}

.btn-53:hover span {
  opacity: 1;
  transform: translateY(0);
}

.btn-53:hover span:nth-child(2) {
  transition-delay: 0.1s;
}

.btn-53:hover span:nth-child(3) {
  transition-delay: 0.2s;
}

.btn-53:hover span:nth-child(4) {
  transition-delay: 0.3s;
}

.btn-53:hover span:nth-child(5) {
  transition-delay: 0.4s;
}

.btn-53:hover span:nth-child(6) {
  transition-delay: 0.5s;
}

        </style>

</head>
<body>

   <header>
       
        <nav>
            <ul>
                <li>
                    <a href="dashboard.php"><button class="btn-53">
                    <div class="original">DASHBOARD</div>
                        <div class="letters"><span>DA</span>
                        <span>SH</span>
                        <span>BO</span>
                        <span>A</span>
                        <span>R</span>
                        <span>D</span></div></button></li></a>
                
            </ul>
        </nav>
    </header>
<section>

</section>


    <h1>User List</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th  style='background:whitesmoke;'>User Id</th><th>Username</th><th>First Name</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["user_name"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td><a href='admin_edit_user.php?user_id=" . $row["user_id"] . "'>Edit</a> | <a href='admin_del_user.php?user_id=" . $row["user_id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found.";
    }

    $conn->close();
    ?>
</body>
</html>
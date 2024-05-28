<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}


// Fetch all forum messages
$messages_sql = "SELECT * FROM tb_data ORDER BY created_at DESC";
$messages_result = $conn->query($messages_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Content Management</title>
    <link rel="stylesheet" href="admin_styles.css">
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
            <li><a href="dashboard.php"><button class="btn-53">
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
<div>
<h1>Admin Dashboard</h1>



<h2>Manage Forum Messages</h2>
<?php
if ($messages_result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Message Text</th><th>User Name</th><th>Date</th><th>Action</th></tr>";
    while ($row = $messages_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["comment"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>
        <a href='delete_message.php?name=" . $row["name"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No messages found.";
}

$conn->close();
?>
</div>
</body>
</html>

<?php
session_start(); // Start the session at the beginning

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital_dynasty";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    // Insert message into discussions table
    $sql = "INSERT INTO discussions (user_id, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("is", $user_id, $message);
        if ($stmt->execute()) {
            echo "Message inserted successfully.";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Fetch discussions and user names
$sql = "SELECT d.message, d.created_at, u.user_name 
        FROM discussions d 
        JOIN user_profiles u ON d.user_id = u.id 
        ORDER BY d.created_at DESC";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        echo "Error getting result: " . $stmt->error;
    }
} else {
    echo "Error preparing select statement: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discussions</title>
</head>
<body>
    <h2>Welcome, <?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : 'Guest'; ?></h2>

    <form method="post" action="discussion.php">
        <textarea name="message" required></textarea>
        <button type="submit">Post</button>
    </form>

    <h3>Discussions</h3>
    <?php if (isset($result) && $result->num_rows > 0): ?>
        <?php while ($discussion = $result->fetch_assoc()): ?>
            <div>
                <strong><?php echo htmlspecialchars($discussion['user_id']); ?></strong>
                <p><?php echo htmlspecialchars($discussion['message']); ?></p>
                <small><?php echo $discussion['created_at']; ?></small>
            </div>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No discussions found.</p>
    <?php endif; ?>
</body>
</html>





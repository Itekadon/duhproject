<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: Admin_login.php");
    exit;
}

if (isset($_GET['name'])) {
    $message_id = $_GET['name'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM tb_data WHERE message_id = ?");
    $stmt->bind_param("i", $message_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Message deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting message.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid message ID.";
}

$conn->close();
header("Location:dashboard.php");
exit;
?>

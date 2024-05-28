
<?php
// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "digital_dynasty"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8
$conn->set_charset("utf8mb4");

// Connection successful
//echo "Connected successfully";
?>

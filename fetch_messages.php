<?php
include("connection.php");

$query = "SELECT discussions.*, user_profiles.profile_picture 
          FROM discussions 
          JOIN user_profiles ON discussions.user_id = user_profiles.id 
          ORDER BY timestamp DESC";
$result = mysqli_query($con, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>

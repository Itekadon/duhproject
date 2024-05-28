<?php 
  // Start a new session or resume the existing session
  session_start();
  
  // Include the configuration file for database connection
  include_once "php/config.php";
  
  // Check if the user is logged in by verifying the session variable
  if(!isset($_SESSION['unique_id'])){
    // If the user is not logged in, redirect to the login page
    header("location: login.php");
  }
?>
<?php 
  // Include the header file which might contain the HTML head and other setup code
  include_once "header.php"; 
?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          // Retrieve the user ID from the GET request and escape special characters
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          
          // Query the database for user information based on the unique ID
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          
          // Check if the query returned any results
          if(mysqli_num_rows($sql) > 0){
            // Fetch the user data as an associative array
            $row = mysqli_fetch_assoc($sql);
          } else {
            // If no user is found, redirect to the users page
            header("location: users.php");
          }
        ?>
        <!-- Back button to return to the users page -->
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <!-- Display the user's profile image -->
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <!-- Display the user's details -->
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <!-- Container for chat messages -->
      <div class="chat-box">

      </div>
      <!-- Form for typing and sending a message -->
      <form action="#" class="typing-area">
        <!-- Hidden field to store the incoming user ID -->
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <!-- Input field for the message -->
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <!-- Submit button with an icon -->
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <!-- JavaScript for handling chat functionality -->
  <script src="javascript/chat.js"></script>

</body>
</html>

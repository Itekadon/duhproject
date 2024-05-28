<?php 
  // Start a new session or resume the existing session
  session_start();
  
  // Include the database configuration file
  include_once "php/config.php";
  
  // Check if the user is logged in by verifying the 'unique_id' session variable
  if(!isset($_SESSION['unique_id'])){
    // If not logged in, redirect the user to the login page
    header("location: login.php");
  } 
?>

<!-- Include the header file -->
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            // Fetch the user details from the database using the unique_id stored in the session
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            
            // Check if the query returned any results
            if(mysqli_num_rows($sql) > 0){
              // Fetch the user data as an associative array
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <!-- Display the user's profile image -->
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <!-- Display the user's full name -->
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <!-- Display the user's status -->
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <!-- Logout link that passes the user's unique ID as a query parameter -->
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Search a user to chat with</span>
        <!-- Search input field for finding users -->
        <input type="text" placeholder="Enter name to search...">
        <!-- Search button with a search icon -->
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <!-- This div will be populated with the list of users via JavaScript -->
      </div>
    </section>
  </div>

  <!-- Include the JavaScript file for handling user interactions -->
  <script src="javascript/users.js"></script>

</body>
</html>

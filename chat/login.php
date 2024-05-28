<?php 
  // Start a new session or resume the existing session
  session_start();
  
  // Check if the user is already logged in by verifying the session variable
  if(isset($_SESSION['unique_id'])){
    // If the user is logged in, redirect to the users page
    header("location: users.php");
  }
?>

<?php 
  // Include the header file which might contain the HTML head and other setup code
  include_once "header.php"; 
?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
      <!-- Login form for the user -->
      <form action="php/login.php"  method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Container for displaying error messages -->
        <div class="error-text"></div>
        <!-- Email input field -->
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <!-- Password input field -->
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i> <!-- Icon for showing/hiding password -->
        </div>
        <!-- Submit button -->
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <!-- Link to signup page if the user is not registered -->
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <!-- JavaScript for password show/hide functionality -->
  <script src="javascript/pass-show-hide.js"></script>
  <!-- JavaScript for handling login form submission -->
  <script src="javascript/login.js"></script>

</body>
</html>


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
    <section class="form signup">
      <header>Realtime Chat App</header>
      <!-- Signup form for the user -->
      <form action="php/signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- Container for displaying error messages -->
        <div class="error-text"></div>
        <!-- Container for name input fields -->
        <div class="name-details">
          <!-- First name input field -->
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <!-- Last name input field -->
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <!-- Email input field -->
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <!-- Password input field -->
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i> <!-- Icon for showing/hiding password -->
        </div>
        <!-- Image upload field -->
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <!-- Submit button -->
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <!-- Link to login page if the user is already registered -->
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <!-- JavaScript for password show/hide functionality -->
  <script src="javascript/pass-show-hide.js"></script>
  <!-- JavaScript for handling signup form submission -->
  <script src="javascript/signup.js"></script>

</body>
</html>

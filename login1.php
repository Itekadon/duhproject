<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="newsignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="signIn.css">


<script>
const x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
</script>

</head>

<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name"><a href="#">
                <!-- Dads Unit Hub -->
                <label for="checkbox">
                    <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
                </label><br><br></a>
        </h2>
        <h1 style="font-size: 50px; text-align: center;">Dads Unity Hub</h1>
        <div class="icon-container">
            <a href="Admin_login.php"><i class="fas fa-user-plus"></i>Admin login</a>
            
            <!-- <a href="/about"><i class="fas fa-info-circle"></i> About Us</a>
                <a href="/resources"><i class="fas fa-book"></i> Resources</a> -->
            <!-- <a href="https://www.youtube.com/shorts/wuxfGb3uATg"> YouTube</a> -->
            </li>
        </div>

        <!-- <nav class="nav">
    <ul class="nav-list">
        <li class="nav-item"><a href="index.html">Home</a></li>
        <li class="nav-item"><a href="about.html">About</a></li>
        <li class="nav-item"><a href="contact.html">Contact</a></li> -->

        <!-- 
	<i class="fa fa-user" aria-hidden="true"></i> -->
    </header>
    <div class="body">


        <nav class="side-bar">
            <div class="user-p">
                <img src="IMAGES 2/Father and children.jpeg">
                <h4>Dads Unit Hub</h4>
            </div>
            <ul>
                <li>
                    <a href="home.html">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="signUp.php">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>Sign up</span>
                    </a>
                </li>
                <li>
                    <a href="Admin_login.php">
                        <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                        <span>Admin Login</span>
                    </a>
                </li>

                <li>
                    <a href="home.html">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>Contact Us</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="section-1" style="background-image: url(./Images/Father\ and\ son\ at\ the\ beach.jpeg);">

            <!-- <p>#Dads Unit Hub</p> -->
            <?php 

session_start();



// Check if registration was successful
if(isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
    echo "Registration successful! You can now login.";  
    // Once the message is displayed, remove it from the session
    unset($_SESSION['registration_success']);
}
 
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "SELECT * FROM user_profiles WHERE user_name = '$user_name' LIMIT 1";
			$result = mysqli_query($con, $query);
            
			if($result)
			{
				if(mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);			
					if($user_data['password'] === $password)
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: profile1.php");
						die;
					}
				}
			}
			
			echo "wrong username or password";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>

            <div class="login">
                <form method="POST" action="login1.php">
                    <h1>LOG IN</h1>
                    <label>Username</label>
                    <input type="email" id="email" name="user_name" required>
                    <label>Password</label>
                    <input type="password"  id="password" name="password" required>
                    <button type="submit" onclick="getLocation()" name="login">Login</button>

                    <p id="demo"></p>
                </form>
            </div>
        </section>
    </div>

</body>

</html
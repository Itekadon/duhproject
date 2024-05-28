<?php 
session_start();

	include("connection.php");
	include("functions.php");    

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{   
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $profile_picture = $_FILES['profile_picture']['name'];
        $biography = $_POST['biography'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $want_nanny = isset($_POST['want_nanny']) ? 1 : 0; // Convert checkbox value to boolean
        $want_partner = isset($_POST['want_partner']) ? 1 : 0; // Convert checkbox value to boolean
        $agree_terms = isset($_POST['agree_terms']) ? 1 : 0; // Convert checkbox value to boolean

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

        // Check if file has been uploaded
        if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // File uploaded successfully
            // Save to database
        } else {
            echo "Sorry, there was an error uploading your file:". $_FILES["profile_picture"]["error"];
        }

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			//save to database
			$user_id = random_num(10);

            $query = "INSERT INTO user_profiles (user_id, first_name, last_name, user_name, password, profile_picture, biography, gender, age, location, want_nanny, want_partner, agree_terms) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $query)) {
            mysqli_stmt_bind_param($stmt, "issssssssiiii", $user_id, $first_name, $last_name, $user_name, $password, $profile_picture, $biography, $gender, $age, $location, $want_nanny, $want_partner, $agree_terms);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);


			// $query = "INSERT INTO user_profiles (user_id,first_name,last_name,user_name,password,profile_picture,biography,gender,age,location,want_nanny,want_partner,agree_terms) 
            // VALUES ('$user_id','$first_name','$last_name','$user_name','$password','$profile_picture','$biography','$gender','$age','$location','$want_nanny','$want_partner','$agree_terms')";

			// mysqli_query($con, $query);

            // Notify the user
        $_SESSION['registration_success'] = true;

        // Redirect the user to the login page
			header("Location: login1.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="newsignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="othersignup.css">
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

<body style="background-color:black;">
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name"><a href="#">
                
                <label for="checkbox">
                    <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
                </label><br><br></a>
        </h2>
        <h1 style="font-size: 50px; text-align: center;">Dads Unity Hub</h1>
        <div class="icon-container">
            <a href="login1.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            </li>
        </div>
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
                    <a href="login1.php">
                        <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                </li>

            </ul>
        </nav>
        <section class="section-1">

            <!-- <p>#Dads Unit Hub</p> -->
<div class="signup-container">
    <div class="signup">
        <form action="signUp.php"method="POST" enctype="multipart/form-data">
            <h1 style="color:#262931;">SIGN UP</h1>

            <div class="form-block">
                <div class="form-group">
                    <label for="first_name" style="background-color:#DDDDDD">First Name:</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                </div>

                <div class="form-group">
                    <label for="last_name" style="background-color:#DDDDDD">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name">
                </div>

                <div class="form-group">
                    <label for="user_name" style="background-color:#DDDDDD">User Name:</label>
                    <input type="email" id="email" name="user_name" placeholder="Email address" required>
                </div>

                <div class="form-group">
                    <label for="password" style="background-color:#DDDDDD">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="profilePicture" style="background-color:#DDDDDD">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
            </div>

            <div class="form-block">
                <div class="form-group">
                    <label for="biography" style="background-color:#DDDDDD">Biography:</label>
                    <textarea id="biography" name="biography" rows="4" cols="50"></textarea>
                </div>

                <div class="form-group">
                    <label for="gender" style="background-color:#DDDDDD">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="age" style="background-color:#DDDDDD">Age:</label>
                    <input type="number" id="age" name="age">
                </div>

                <div class="form-group">
                    <label for="location" style="background-color:#DDDDDD">Location:</label>
                    <select id="location" name="location">
                        <option value="Eastern Cape">Eastern Cape</option>
                        <option value="Free State">Free State</option>
                        <option value="Gauteng">Gauteng</option>
                        <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                        <option value="Limpopo">Limpopo</option>
                        <option value="Mpumalanga">Mpumalanga</option>
                        <option value="North West">North West</option>
                        <option value="Northern Cape">Northern Cape</option>
                        <option value="Western Cape">Western Cape</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nanny" style="background-color:#DDDDDD">Would you want a nanny?</label>
                    <input type="checkbox" id="nanny" name="want_nanny">
                </div>

                <div class="checkbox-container">
                    <label for="partner" style="background-color:#DDDDDD">Would you want to find a possible partner to date?</label>
                    <input type="checkbox" id="partner" name="want_partner" onclick="togglePartner()">
                </div>

                <div class="form-group">
                    <label for="agree" style="background-color:#DDDDDD">I agree to the terms and conditions. <a href="#">Terms and Conditions</a></label>
                    <input type="checkbox" id="agree" name="agree_terms">
                </div>

                <button type="submit" onclick="getLocation()" name="submit" style="background-color:#262931;">Sign Up</button><br><br>
                <p id="demo"></p>

                <h3>Already A Member?</h3>
                <br>
                <div class="login_button">
                    <button><a href="login1.php">Login</a></button>
                </div>
            </div>
        </form>
    </div>

    <div class="picture-container">
        <img src="IMAGES 2/Father and daughter.jpeg" alt="Signup Picture">
    </div>
</div>


        </section>
    </div>

</body>

</html
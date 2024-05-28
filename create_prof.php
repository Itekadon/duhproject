<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link rel="stylesheet" href="join.css">
    <link rel="stylesheet" href="joi_animations.css">
    <link rel="icon" type="image/jpeg" href="./logo.jpeg">

    <header>
        <h1 style="color: rgb(173, 11, 11);font-family: comic sans;" >DadsUnityHub</h1>
        <!-- <h2>Empowering Single Dads, One Step at a Time</h2> -->
        <nav>
          <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="#resources">Resources</a></li>
            <li><a href="#community">Community</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </nav>
      </header>
</head>
<body>
    <form id="memberProfileForm"  action="post">
      <h2>Create Your Profile!</h2>
      
        <label for="fname">First Name:</label> 
        <input type="text" id="fname" name="firstName">
      
        <label for="lname">Last Name:</label>
        <input type="text" id=" lname" name="lastName">
    
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
        </select><br>
      
        <label for="age">Age:</label>
        <input type="number" id="age" name="age"><br>
      
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname"><br>
      
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email"><br>
      
        <!-- <label for="confirmEmail">Retype Email Address:</label>
        <input type="email" id="confirmEmail" name="confirmEmail"><br>
      
        <label for="password">Choose a Password:</label>
        <input type="password" id="password" name="password"><br>
      
        <label for="confirmPassword">Retype Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword"><br>  -->
       
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate"><br>
      
        <label for="location">Location:</label>
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
        </select><br>
      
        
        <label for="nanny">Would you want a nanny?</label>
        <input type="checkbox" id="nanny" name="nanny"><br>
        
      
        <div class="checkbox-container">
          <label for="partner">Would you want to find a possible partner to date?</label>
          <input type="checkbox" id="partner" name="partner" onclick="togglePartner()"/>
        </div>
          
         
        <label for="agree">I agree to the terms and conditions. <a href="#">Terms and Conditions</a></label><br>
        <input type="checkbox" id="agree" name="agree">
      
        <button type="submit">Join</button>
      </form>
</body>
</html>
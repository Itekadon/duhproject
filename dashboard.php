<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
  <link rel="icon" type="image/jpeg" href="./logo.jpeg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css">
    <style>
       /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: Arial, sans-serif;
    background-color: whitesmoke;
    color: rgb(6, 6, 32);
    line-height: 1.6;
}

/* Header styling */
header {
    background-color: rgb(6, 6, 32);
    color:whitesmoke;
    padding: 20px 0;
    text-align: center;
    position: fixed;
    width: 100%;
    height:3cm;
    top: 0;
    left: 0;
    z-index: 1000;
    border-bottom:1px solid white;
}

header h1 {
    margin-bottom: 10px;
    margin-top: 10px;
}

header nav ul {
    list-style: none;
}

header nav ul li {
    display: inline;
    margin-right: 15px;
}

header nav ul li a {
    color: whitesmoke;
    text-decoration: none;
    font-weight: bold;
}

header nav ul li a:hover {
    text-decoration: underline;
 
}

/* Sidebar styling */
aside {
    background-color: rgb(6, 6, 32);
    color: whitesmoke;
    padding: 20px;
    width: 200px;
    position: fixed;

    top: 0px; /* Adjust based on the height of your header */
    left: 0;
    bottom: 0;
    z-index: 900;
}

aside h2 {
    margin-bottom: 20px;
}

aside ul {
    list-style: none;
}

aside ul li {
    margin-bottom: 36px;
    
}

aside ul li a {
    color: whitesmoke;
    text-decoration: none;
    font-weight: bold;
}

aside ul li a:hover {
    text-decoration: underline;
}

/* Main content styling */




/* Footer styling */
footer {
    background-color: blue;
    color: whitesmoke;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
    left: 0;
}

/* Form button styling */
form input[type="submit"] {
    padding: 10px 20px;
    background-color: rgb(6, 6, 32);
    color: whitesmoke;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

form input[type="submit"]:hover {
    background-color: rgb(6, 6, 32);
}

    </style>
</head>
<body>
    <header>
        <!-- Logo or site name -->
        <h1 style="color:whitesmoke">Admin Dashboard</h1>
    </header>
    <aside>
        <br>
        <br>
        <br>
        <br>
        <br>
      
        <h2 style="color:whitesmoke;">Sidebar</h2>
        <ul>
            <li><a href="home.html">Overview</a></li>
            <li><a href="user_management.php">User Management</a></li>
            <li><a href="content_management.php">Content Management</a></li>
            <li><a href="Admin_logout.php">Logout</a></li>
            <hr style="color:whitesmoke;margin-top:6.4cm;">
        </ul>
    </aside>
    <main>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    
    </main>
    
    <footer>
        <!-- Footer content -->
        
        <p>&copy; 2024 Digital Dynasty Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>

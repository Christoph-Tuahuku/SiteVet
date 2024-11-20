<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteVet - Livestock Disease Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
    <header>   
    <div class="navbar">
        <div class= "icon">
            <div class="logo"><img src="../images/SiteVet.png" width="100" height="90" alt=""/></div>
               
              <nav class="menu">
                <a href="index.php">Home</a>
                 <a href="login_html.php">Login</a>
                 <a href="register_html.php">Register</a>
                 <a href="contactus_copy.php">Contact Us</a>
                  <div class="search"><input type= "search" name="" placeholder="Type text">
                  <button class= "btn">Search</button>
                  </div>
            
                </nav>
        </div>
    </div>
    </header>
 
        <h2>Register</h2>
        <form action="php/register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Register</button>
        </form>
    <footer>
        <div class="footer-content">
            <p>Enhancing livestock health management through easy-to-use tools for farmers and veterinarians.</p>
            <p>Contact us at: support@index.com</p>
            <p><a href="#">Privacy Policy</a></p>
        </div>
    </footer>

</body>
</html>

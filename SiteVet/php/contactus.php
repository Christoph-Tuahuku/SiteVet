<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteVet - Contact Us</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
    <header>
    <div class="navbar">
        <div class="icon">
            <div class="logo"><img src="../images/SiteVet.png" width="100" height="90" alt=""/></div>
            <nav class="menu">
                <a href="index_copy.php">Home</a>
                <a href="diseasetracker.php">Disease Tracker</a>
                <a href="treatmentrecords.php">Treatment Records</a>
                <a href="vaccinationschedule.php">Vaccination Schedule</a>
                <a href="diseasereport.php">Disease Report</a>
                <a href="contactus.php">Contact Us</a>
                <a href='logout.php'>Logout</a>

                <div class="search"><input type="search" name="" placeholder="Type text">
                <button class="btn">Search</button>
                </div>
            </nav>
        </div>
    </div>
    </header>

    <div class="about">
        <h1>Wellness and Vaccination Programs</h1>
        <p>One of the best things you can do for your livestock is to keep them healthy. One of the easiest and least expensive ways to do that is by regularly examining and vaccinating your livestock. Wellness programs allow us to diagnose diseases and conditions early, when they’re easier to treat or manage. Often, we can help prevent diseases entirely, just by ensuring that your livestock has received appropriate vaccinations and preventives. We’ll work with you to create an individualized wellness program, including a vaccination and prevention protocol customized specifically to your livestock. Contact us today to schedule your livestock’s wellness exam.</p>
    </div>

    <div class="contact">
        <div class="contact-image">
            <img src="../images/Untitled design.png" width="406" height="565" />
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form action="php/contact_us.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>

                <label for="phonenum">Phone Number:</label>
                <input type="phone" id="phonenum" name="phonenum" placeholder="Your Phone Number" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <p>Enhancing livestock health management through easy-to-use tools for farmers and veterinarians.</p>
            <p>Contact us at: support@index.com</p>
            <p><a href="#">Privacy Policy</a></p>
        </div>
    </footer>

</body>
</html>

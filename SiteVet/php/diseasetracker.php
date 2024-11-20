<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteVet - Livestock Disease Tracker</title>
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

                    <div class="search"><input type="search" placeholder="Type text">
                        <button class="btn">Search</button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <h1>Disease Tracker</h1>
        <p>Submit details about a disease sample to check if it matches any known diseases in our database.</p>

        <!-- Disease Tracker Form -->
        <form action="php/disease_tracker.php" method="POST">
            <label for="symptoms">Symptoms:</label>
            <input type="text" name="symptoms" id="symptoms" required placeholder="Enter symptoms here">

            <label for="sample_details">Sample Details:</label>
            <textarea name="sample_details" id="sample_details" required placeholder="Describe sample details"></textarea>

            <button type="submit">Submit</button>
        </form>

      <!-- Display Disease Results -->
      <div id="results">
            <?php
                session_start(); // Start the session

                // Check if disease results are available in the session
                if (isset($_SESSION['diseaseResults'])) {
                    echo $_SESSION['diseaseResults']; // Display the results
                    unset($_SESSION['diseaseResults']); // Clear the session variable after displaying
                }
            ?>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>Enhancing livestock health management through easy-to-use tools for farmers and veterinarians.</p>
            <p>Contact us at: support@index.com</p>
            <p><a href="#">Privacy Policy</a></p>
        </div>
    </footer>

</body>
</html>

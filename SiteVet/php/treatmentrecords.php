<?php
// Include database connection
include('C:/xampp/htdocs/SiteVet/../DB/db_connection.php');

// Fetch diseases from the database for the dropdown
$diseases_result = $conn->query("SELECT id, name FROM Diseases");

// Close the connection after fetching data for the dropdown
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteVet - Treatment Records</title>
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
        <h1>Treatment Records</h1>
        <p>Submit treatment details for a disease.</p>

        <!-- Display success or error message -->
        <div id="message"></div>

        <!-- Treatment Records Form -->
        <form id="treatmentForm" method="POST" action="treatment_records.php">
            <label for="disease_id">Disease:</label>
            <select name="disease_id" id="disease_id" required>
                <?php
                // Fetch diseases from the database to populate the dropdown
                if ($diseases_result->num_rows > 0) {
                    while ($row = $diseases_result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                }
                ?>
            </select>

            <label for="treatment_details">Treatment Details:</label>
            <textarea name="treatment_details" id="treatment_details" required placeholder="Enter treatment details here"></textarea>

            <label for="date_treated">Date Treated:</label>
            <input type="date" name="date_treated" id="date_treated" required>

            <label for="treated_by">Treated By:</label>
            <input type="text" name="treated_by" id="treated_by" required placeholder="Enter the name of the person who treated the animal">

            <button type="submit">Submit</button>
        </form>

        <h2>Existing Treatment Records</h2>
        <table id="treatmentRecordsTable">
            <thead>
                <tr>
                    <th>Disease Name</th>
                    <th>Treatment Details</th>
                    <th>Date Treated</th>
                    <th>Treated By</th>
                </tr>
            </thead>
            <tbody>
                <!-- Existing treatment records will be loaded here by JS -->
            </tbody>
        </table>
    </main>

    <footer>
        <div class="footer-content">
            <p>Enhancing livestock health management through easy-to-use tools for farmers and veterinarians.</p>
            <p>Contact us at: support@index.com</p>
            <p><a href="#">Privacy Policy</a></p>
        </div>
    </footer>

    <script>
        // Fetch existing treatment records from the backend when the page loads
        window.onload = function() {
            fetch('php/treatment_records.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#treatmentRecordsTable tbody');
                    tableBody.innerHTML = "";  // Clear any existing rows

                    if (data.length > 0) {
                        data.forEach(record => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${record.name}</td>
                                <td>${record.treatment_details}</td>
                                <td>${record.date_treated}</td>
                                <td>${record.treated_by}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = "<td colspan='4'>No treatment records found.</td>";
                        tableBody.appendChild(row);
                    }
                })
                .catch(error => {
                    console.error('Error fetching treatment records:', error);
                });
        };

        // Handle form submission via AJAX (prevent default form submission)
        document.getElementById('treatmentForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent normal form submission

            const formData = new FormData(this);

            fetch('treatment_records.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('message').innerHTML = "<p style='color:green;'>Treatment record added successfully.</p>";
                    // Optionally reload records or refresh the treatment table
                    window.onload();  // Reload the table with updated records
                } else {
                    document.getElementById('message').innerHTML = "<p style='color:red;'>Failed to add treatment record.</p>";
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                document.getElementById('message').innerHTML = "<p style='color:red;'>An error occurred while submitting the form.</p>";
            });
        });
    </script>
</body>
</html>

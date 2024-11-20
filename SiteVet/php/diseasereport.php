<?php
// Include database connection
include('C:/xampp/htdocs/SiteVet/../DB/db_connection.php');

// Fetch existing disease reports from the database
$records_result = $conn->query("SELECT * FROM Disease_Reports");

// Close the connection after fetching data for the records display
$conn->close();
?>

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
            <div class="icon">
                <div class="logo"><img src="../images/SiteVet.png" width="100" height="90" alt=""/></div>
                <nav class="menu">
                
               <a href="index_copy.php">Home</a>
                <a href="diseasetracker.php">Disease Tracker</a>
                <a href="treatmentrecords.php">Treatment Records</a>
                <a href="vaccinationschedule.php">Vaccination Schedule</a>
                <a href="diseasereport.php">Disease Report</a>
                <a href="contactus.php">Contact Us</a>
                <a href="logout.php">Logout</a>

                    <div class="search"><input type="search" placeholder="Type text">
                        <button class="btn">Search</button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <h2>Animal Disease Report</h2>

        <form id="diseaseReportForm">
            <label for="animalId">Animal ID:</label>
            <input type="text" id="animalId" required>

            <label for="diseaseName">Disease Name:</label>
            <input type="text" id="diseaseName" required>

            <label for="symptoms">Symptoms:</label>
            <textarea id="symptoms" required></textarea>

            <label for="reportDate">Report Date:</label>
            <input type="date" id="reportDate" required>

            <label for="severity">Severity:</label>
            <select id="severity" required>
                <option value="Mild">Mild</option>
                <option value="Moderate">Moderate</option>
                <option value="Severe">Severe</option>
            </select>

            <button type="submit">Submit Report</button>
        </form>

        <h3>Existing Disease Reports:</h3>
        <table id="diseaseReportsTable">
            <thead>
                <tr>
                    <th>Animal ID</th>
                    <th>Disease Name</th>
                    <th>Symptoms</th>
                    <th>Report Date</th>
                    <th>Severity</th>
                </tr>
            </thead>
            <tbody>
                <!-- Existing disease reports will be loaded here by JS -->
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
        // Fetch existing disease reports from the backend when the page loads
        window.onload = function() {
            fetch('php/disease_report.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#diseaseReportsTable tbody');
                    tableBody.innerHTML = "";  // Clear any existing rows

                    if (data.length > 0) {
                        data.forEach(record => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${record.animal_id}</td>
                                <td>${record.disease_name}</td>
                                <td>${record.symptoms}</td>
                                <td>${new Date(record.report_date).toLocaleDateString()}</td>
                                <td>${record.severity}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = "<td colspan='5'>No disease reports found.</td>";
                        tableBody.appendChild(row);
                    }
                })
                .catch(error => {
                    console.error('Error fetching disease reports:', error);
                });
        };

        // Handle form submission via AJAX (prevent default form submission)
        document.getElementById('diseaseReportForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent normal form submission

            const animalId = document.getElementById('animalId').value;
            const diseaseName = document.getElementById('diseaseName').value;
            const symptoms = document.getElementById('symptoms').value;
            const reportDate = new Date(document.getElementById('reportDate').value);
            const severity = document.getElementById('severity').value;

            // Send data to the backend for saving
            const formData = new FormData();
            formData.append('animal_id', animalId);
            formData.append('disease_name', diseaseName);
            formData.append('symptoms', symptoms);
            formData.append('report_date', reportDate.toISOString().split('T')[0]);
            formData.append('severity', severity);

            fetch('disease_report.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Disease report added successfully.');
                    window.onload();  // Refresh the disease reports table
                } else {
                    alert('Failed to add disease report.');
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                alert('An error occurred while submitting the form.');
            });
        });
    </script>
</body>
</html>

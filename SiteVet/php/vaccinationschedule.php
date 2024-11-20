<?php
// Include database connection
include('C:/xampp/htdocs/SiteVet/../DB/db_connection.php');

// Fetch existing vaccination records from the database
$records_result = $conn->query("SELECT * FROM Vaccination_Records");

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
                <a href='logout.php'>Logout</a>

                    <div class="search"><input type="search" placeholder="Type text">
                        <button class="btn">Search</button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <h2>Animal Vaccination Schedule</h2>

        <form id="vaccinationForm">
            <label for="animalId">Animal ID:</label>
            <input type="text" id="animalId" required>

            <label for="vaccinationDate">Vaccination Date:</label>
            <input type="date" id="vaccinationDate" required>

            <label for="vaccinationType">Vaccination Type:</label>
            <input type="text" id="vaccinationType" required>

            <label>
                <input type="checkbox" id="isDeceased"> Animal is deceased
            </label>

            <div id="deceasedInfo" style="display:none;">
                <label for="deceasedId">Type in Animal ID (deceased):</label>
                <input type="text" id="deceasedId">
            </div>

            <button type="submit">Generate Schedule</button>
        </form>

        <h3>Vaccination Schedule:</h3>
        <ul id="scheduleList"></ul>

        <h3>Existing Vaccination Records:</h3>
        <table id="vaccinationRecordsTable">
            <thead>
                <tr>
                    <th>Animal ID</th>
                    <th>Vaccination Date</th>
                    <th>Vaccination Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Existing vaccination records will be loaded here by JS -->
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
        // Fetch existing vaccination records from the backend when the page loads
        window.onload = function() {
            fetch('php/vaccination_records.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#vaccinationRecordsTable tbody');
                    tableBody.innerHTML = "";  // Clear any existing rows

                    if (data.length > 0) {
                        data.forEach(record => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${record.animal_id}</td>
                                <td>${new Date(record.vaccination_date).toLocaleDateString()}</td>
                                <td>${record.vaccination_type}</td>
                                <td>${record.is_deceased ? 'Deceased' : 'Alive'}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = "<td colspan='4'>No vaccination records found.</td>";
                        tableBody.appendChild(row);
                    }
                })
                .catch(error => {
                    console.error('Error fetching vaccination records:', error);
                });
        };

        // Handle form submission via AJAX (prevent default form submission)
        document.getElementById('vaccinationForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent normal form submission

            const animalId = document.getElementById('animalId').value;
            const vaccinationDate = new Date(document.getElementById('vaccinationDate').value);
            const vaccinationType = document.getElementById('vaccinationType').value;

            // Check if the animal is deceased
            const isDeceased = document.getElementById('isDeceased').checked;
            const deceasedId = isDeceased ? document.getElementById('deceasedId').value : '';

            // Send data to the backend for saving
            const formData = new FormData();
            formData.append('animal_id', animalId);
            formData.append('vaccination_date', vaccinationDate.toISOString().split('T')[0]);
            formData.append('vaccination_type', vaccinationType);
            formData.append('is_deceased', isDeceased ? 1 : 0);
            formData.append('deceased_id', deceasedId);

            fetch('vaccination_records.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Vaccination record added successfully.');
                    window.onload();  // Refresh the vaccination records table
                } else {
                    alert('Failed to add vaccination record.');
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

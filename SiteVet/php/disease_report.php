<?php
// Include database connection
include('../DB/db_connection.php');

// Initialize variables for messages
$successMessage = "";
$errorMessage = "";

// Handle form submission (for adding a new disease report)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $animal_id = $_POST['animal_id'];
    $disease_name = $_POST['disease_name'];
    $symptoms = $_POST['symptoms'];
    $report_date = $_POST['report_date'];
    $severity = $_POST['severity']; // For example: Mild, Moderate, Severe

    // Insert disease report into the database
    $insert_query = "INSERT INTO Disease_Reports (animal_id, disease_name, symptoms, report_date, severity)
                     VALUES ('$animal_id', '$disease_name', '$symptoms', '$report_date', '$severity')";

    if ($conn->query($insert_query)) {
        $successMessage = "Disease report successfully added.";
    } else {
        $errorMessage = "Failed to add disease report: " . $conn->error;
    }
}

// Fetch all disease reports (for displaying)
$records_result = $conn->query("SELECT * FROM Disease_Reports");

// Return records in JSON format to the frontend
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $records = [];
    if ($records_result->num_rows > 0) {
        while ($row = $records_result->fetch_assoc()) {
            $records[] = $row;
        }
    }
    echo json_encode($records);  // Send the records as JSON
}

// Close the database connection
$conn->close();

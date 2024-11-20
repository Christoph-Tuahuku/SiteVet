<?php
// Include database connection
include('../DB/db_connection.php');

// Initialize variables for messages
$successMessage = "";
$errorMessage = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $disease_id = $_POST['disease_id'];
    $treatment_details = $_POST['treatment_details'];
    $date_treated = $_POST['date_treated'];
    $treated_by = $_POST['treated_by'];

    // Insert treatment record into the database
    $insert_query = "INSERT INTO Treatment_Records (disease_id, treatment_details, date_treated, treated_by)
                     VALUES ('$disease_id', '$treatment_details', '$date_treated', '$treated_by')";

    if ($conn->query($insert_query)) {
        $successMessage = "Treatment record successfully added.";
    } else {
        $errorMessage = "Failed to add treatment record: " . $conn->error;
    }
}

// Fetch diseases from the database for the dropdown
$diseases_result = $conn->query("SELECT id, name FROM Diseases");

// Fetch existing treatment records for display
$records_result = $conn->query("SELECT t.treatment_details, t.date_treated, t.treated_by, d.name 
                                FROM Treatment_Records t
                                JOIN Diseases d ON t.disease_id = d.id");

// Return data in JSON format to the frontend (for fetching treatment records)
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

<?php
// Include database connection
include('../DB/db_connection.php');

// Initialize variables for messages
$successMessage = "";
$errorMessage = "";

// Handle form submission (for generating the vaccination schedule and saving it)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $animal_id = $_POST['animal_id'];
    $vaccination_date = $_POST['vaccination_date'];
    $vaccination_type = $_POST['vaccination_type'];
    $is_deceased = isset($_POST['is_deceased']) ? 1 : 0; // 1 for deceased, 0 for alive
    $deceased_id = isset($_POST['deceased_id']) ? $_POST['deceased_id'] : null;

    // Insert vaccination record into the database
    $insert_query = "INSERT INTO Vaccination_Records (animal_id, vaccination_date, vaccination_type, is_deceased, deceased_id)
                     VALUES ('$animal_id', '$vaccination_date', '$vaccination_type', '$is_deceased', '$deceased_id')";

    if ($conn->query($insert_query)) {
        $successMessage = "Vaccination record successfully added.";
    } else {
        $errorMessage = "Failed to add vaccination record: " . $conn->error;
    }
}

// Fetch all vaccination records (for displaying)
$records_result = $conn->query("SELECT * FROM Vaccination_Records");

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

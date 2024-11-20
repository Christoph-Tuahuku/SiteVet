<?php
session_start(); // Start the session
require '../DB/db_connection.php'; // Include the database connection file

// Initialize the results variable
$diseaseResults = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $symptoms = $conn->real_escape_string($_POST['symptoms']);
    $sample_details = $conn->real_escape_string($_POST['sample_details']);

    // Search the database for diseases that match the symptoms
    $query = "SELECT * FROM Diseases WHERE symptoms LIKE '%$symptoms%'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $diseaseResults .= "<h2>Disease Results</h2>";
        while ($row = $result->fetch_assoc()) {
            $diseaseResults .= "<div class='disease-result'>";
            $diseaseResults .= "<p><strong>Disease Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
            $diseaseResults .= "<p><strong>Symptoms:</strong> " . htmlspecialchars($row['symptoms']) . "</p>";
            $diseaseResults .= "<p><strong>Causes:</strong> " . htmlspecialchars($row['causes']) . "</p>";
            $diseaseResults .= "<p><strong>Prevention:</strong> " . htmlspecialchars($row['prevention']) . "</p>";
            $diseaseResults .= "<p><strong>Treatment:</strong> " . htmlspecialchars($row['treatment']) . "</p>";
            $diseaseResults .= "</div><hr>";
        }
    } else {
        $diseaseResults = "<p>No matching disease found.</p>";
    }

    // Store results in the session
    $_SESSION['diseaseResults'] = $diseaseResults;

    // Log the submission in the Disease_Submissions table (if needed)
    $submissionQuery = "INSERT INTO Disease_Submissions (disease_id, sample_details) VALUES (NULL, '$sample_details')";
    $conn->query($submissionQuery);

    // Close the connection
    $conn->close();

    // Redirect back to the disease tracker page to display the results
    header('Location: ..diseasetracker.php');
    exit();
}


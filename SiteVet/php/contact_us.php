<?php
// Include the database connection
include_once('../DB/db_connection.php');  // Adjust the path as necessary

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phonenum = $_POST['phonenum'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare the SQL query
    $sql = "INSERT INTO contact_us (name, phonenum, email, message) VALUES ('$name', '$phonenum', '$email', '$message')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Your message has been submitted. We will get back to you shortly.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

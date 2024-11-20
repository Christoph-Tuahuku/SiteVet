<?php 
session_start();
require '../DB/db_connection.php'; // Include DB connection code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Debug if prepare fails
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $username, $hashed_password);

    if ($stmt->fetch()) { // Fetch will return true if a user is found
        if (password_verify($password, $hashed_password)) {
            // Close the first statement before running a new query
            $stmt->close();

            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            // Optionally log session
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $session_stmt = $conn->prepare("INSERT INTO sessions (user_id, ip_address) VALUES (?, ?)");
            if (!$session_stmt) {
                die("Session prepare failed: " . $conn->error);
            }
            $session_stmt->bind_param("is", $id, $ip_address);
            $session_stmt->execute();
            $session_stmt->close();

            header("Location: index_copy.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $stmt->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}

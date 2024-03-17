<?php
include "dbconn.php";
session_start(); // Starting the session

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Error: " . mysqli_error($conn));
    } else {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Get result
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if there is a row with given username and password
        if (mysqli_num_rows($result) == 1) {
            // User found, set session variable
            $_SESSION['username'] = $username;
            echo "Welcome!";
            header('Location: index.php');
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>

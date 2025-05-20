<?php
// register.php

$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP password is empty
$dbname = "website try";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$plain_password = $_POST['password'];
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT); // hashed password
$usertype = 'user'; // default user type

// Insert user
$sql = "INSERT INTO users (fullname, email, password, usertype)
        VALUES ('$fullname', '$email', '$hashed_password', '$usertype')";

if ($conn->query($sql) === TRUE) {
    echo "<p>Registration successful. <a href='login.html'>Login now</a></p>";
} else {
    echo "<p>Error: " . $conn->error . "</p>";
}

$conn->close();
?>

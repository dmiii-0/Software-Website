<?php
// login.php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website try";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password_input = $_POST['password'];
$usertype = $_POST['usertype'];

// Check user in DB
$sql = "SELECT * FROM users WHERE email='$email' AND usertype='$usertype'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password_input, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['usertype'] = $user['usertype'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p>Incorrect password. <a href='login.html'>Try again</a></p>";
    }
} else {
    echo "<p>User not found or invalid user type. <a href='login.html'>Try again</a></p>";
}

$conn->close();
?>

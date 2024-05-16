<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "metro";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Username2 = $_POST['Username'];
    $Password2 = $_POST['password'];

    // Prepare SQL statement to check if username and password exist in user_reg table
    $stmt = $conn->prepare("SELECT * FROM user_reg WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $Username2, $Password2);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a matching record in user_reg table
    if ($result->num_rows > 0) {
        // Matching credentials found, redirect to home page
        header("Location: home.html");
        exit(); // Stop further execution
    } else {
        // No matching record found, display message and redirect after some time
        echo "User not found. Redirecting to registration page...";
        echo "<script>setTimeout(function(){window.location.href='register.html';}, 2000);</script>";
        exit(); // Stop further execution
    }

    // Close prepared statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

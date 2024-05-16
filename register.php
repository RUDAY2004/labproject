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
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    // Retrieve form data
    $username = $_POST['username'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO user_reg (username, name, gender, email, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $username, $name, $gender, $email, $phonenumber, $password);

    // Execute the SQL statement
    if ($stmt->execute() === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

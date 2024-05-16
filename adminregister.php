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
    $adminname = $_POST['username']; // Assuming 'username' corresponds to 'adminname'
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO admin_reg (adminname, name, gender, email, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $adminname, $name, $gender, $email, $phonenumber, $password);

    // Execute the SQL statement
    if ($stmt->execute() === TRUE) {
        header("Location: admin.html"); // Redirect after successful registration
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

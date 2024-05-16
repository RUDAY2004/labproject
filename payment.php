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
    $userId = $_POST['userId'];
    $paymentId = $_POST['paymentId'];
    $transactionId = $_POST['transactionId'];
    $amount = $_POST['amount'];

    // Prepare SQL statement to insert payment details into payments table
    $stmt = $conn->prepare("INSERT INTO payment (userid, paymentid, transactionid, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $userId, $paymentId, $transactionId, $amount);
    $stmt->execute();

    // Check if the payment data is inserted successfully
    if ($stmt->affected_rows > 0) {
        echo "Payment details stored successfully.";
    } else {
        echo "Error storing payment details.";
    }

    // Close prepared statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreviewphp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbluseraccount WHERE Username = ? AND Password = ?"; // assumes you have a tbluseraccount table with Username and Password columns
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $_POST['username'], $_POST['password']); // Replace with hashed password in production
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  session_start();
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $_POST['username'];
  header("Location: index.php");
} else {
  echo "Invalid credentials";
}

$conn->close();
?>

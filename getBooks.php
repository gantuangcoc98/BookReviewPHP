<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Book_Key, Title, Category_Key, ISBN, Authors_Firstname, Authors_Lastname FROM tblbook";
$result = $conn->query($sql);

$books = array();
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $books[] = $row;
  }
} 

echo json_encode($books);

$conn->close();
?>

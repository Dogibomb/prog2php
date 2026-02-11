<?php
$_SERVER = "localhost/"
$user = "localhost"
$pasw = "heslo"
$db = "mojedatabaze"

// Create connection
$conn = new mysqli($_SERVER, $user, $pasw, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
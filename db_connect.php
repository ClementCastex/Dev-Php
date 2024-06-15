<?php
$servername = "localhost";
$username = "OmeghyPe";
$password = "LeeLoo&TsuKi_76";
$database = "portfolio";  

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
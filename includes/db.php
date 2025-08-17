<?php
$host = 'localhost';
$user = 'root';
$port=3306;
$password = '';
$dbname = 'voting_system';
$conn = new mysqli($host, $user, $password, $dbname,$port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
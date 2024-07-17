<?php
$servername = "localhost";
$username = "gellena";
$password = "potpot16";
$dbname = "utilities";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

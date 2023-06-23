<?php
//Variables for database connection
$servername = "localhost";
$username = "xxxx";
$password = "xxxx";
$database = "xxxx";

//Connecting to the database.
$conn = new mysqli($servername, $username, $password, $database);

//Checking for ceonnection errors:
if ($conn->connect_error) {
    die("<Connection failed: " . $conn->connect_error);
}

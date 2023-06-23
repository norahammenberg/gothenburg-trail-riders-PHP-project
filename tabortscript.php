<?php
//connect to the DB
require_once("connecttodb.php");

//preparing and bind a sql query to avoid sql injections 
$sql = "DELETE FROM goteborgsstigcyklisterevent WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

//Variable 
$id = $_POST["id"];

//execute the sql query
$stmt->execute();

if ($stmt->affected_rows === 1) {
  include "tabort.php";
  echo "<p class='content wrapper'> Event deleted. </p>";
} else if ($stmt->affected_rows === 0) {
  include "tabort.php";
  echo "<p class='content wrapper'>Please provide event ID</p>";
}
//close connection
$stmt->close();
$conn->close();

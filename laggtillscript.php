<?php
//connecting to the database:
require_once("connecttodb.php");

//preparing and bind a sql query to avoid sql injections 
$sql = "INSERT INTO goteborgsstigcyklisterevent (namn, plats, datum, tid, pris) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $namn, $plats, $datum, $tid, $pris);

//variables
$namn = $_POST["namn"];
$plats = $_POST["plats"];
$datum = $_POST["datum"];
$tid = $_POST["tid"];
$pris = $_POST["pris"];

//execute the sql query:
$stmt->execute();

if ($stmt->affected_rows === 1) {
  include "laggtill.php";
  echo "<p class='content wrapper'>New event have been created. </p>";
} else {
  include "laggtill.php";
  echo "<p class='content wrapper'>Please fill in all rows.</p>";
}

//close database conenction:
$stmt->close();
$conn->close();

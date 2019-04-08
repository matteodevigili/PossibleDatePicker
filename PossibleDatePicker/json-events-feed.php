<?php

include_once './config/dbConnection.php';

$conn = @new mysqli($host, $user, $psw, $database);
if ($conn->connect_error) {
    header("location: error.php?error=" . $conn->connect_error);
}

$sql = "SELECT * FROM $tabellaEventi";
$result = $conn->query($sql);

$events = array();

foreach ($result as $row) {

    $e = array();
    $e['id'] = $row['id'];
    $e['title'] = $row["title"];
    $e['start'] = $row['start'];
    $e['end'] = $row['end'];
    $e['allDay'] = false;

    array_push($events, $e);
}

echo json_encode($events);
exit();

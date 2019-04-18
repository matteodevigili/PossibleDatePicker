<?php

include_once './config/dbConnection.php';

$conn = @new mysqli($host, $user, $psw, $database);
if ($conn->connect_error) {
    header("location: error.php?error=" . $conn->connect_error);
}

$sql = "SELECT * FROM $tabellaEventi";
$result = $conn->query($sql);

$events = array();
$e = array();
$colorMap = array();
$colors = array("#f44336", "#2196f3", "#009688", "#d8d82d", "#ff9800", "#9e9e9e", "#607d8b");
$iColors = 0;


foreach ($result as $row) {
    $e['id'] = $row['id'];
    $e['title'] = $row["title"];
    $e['start'] = $row['start'];
    $e['end'] = $row['end'];
    $e['allDay'] = false;
    if(!isset($colorMap[$row["title"]])){
        
        $colorMap[$row["title"]] = $colors[$iColors];
        $e["color"] = $colorMap[$row["title"]];
        
        $iColors++;
        if($iColors == 7){
            $iColors = 0;
        }
    }else{
        $e["color"] = $colorMap[$row["title"]];
    }

    array_push($events, $e);
}

$conn->close();
echo json_encode($events);
exit();

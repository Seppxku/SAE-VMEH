<?php

session_start();
require_once '../config/db.php';



$sql = "SELECT * FROM Mission ";
$stmt = $pdo->query($sql);


$events = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'id'    => $row['IdMission '],
        'title' => $row['TitreMission '],
        'start' => $row['DateHeureDébutMission '],
        'end'   => $row['DateHeureFinMission '],
        'color' => '#0d6efd',
        'extendedProps' => [
            'description' => $row['DescriptionMission '],
            'categories' => $row['CatégorieMission'],
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($events);

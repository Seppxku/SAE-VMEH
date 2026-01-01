<?php

session_start();
require_once '../config/db.php';

$events = [];

$sqlEvenements = "
  SELECT 
    IdEvenement AS id,
    TitreEvenement AS titre,
    DescriptionEvenement AS description,
    DateEvenement AS start,
    LieuEvenement AS lieu,
    ThemeEvenement AS theme
  FROM Evenement
";
$stmt = $pdo->query($sqlEvenements);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'id'    => 'E' . $row['id'], // E = Évènement
        'title' => $row['titre'],
        'start' => $row['start'],
        'color' => '#198754', // vert
        'extendedProps' => [
            'type' => 'evenement',
            'description' => $row['description'],
            'lieu' => $row['lieu'],
            'theme' => $row['theme']
        ]
    ];
}


$sqlMissions = "
  SELECT
    IdMission AS id,
    TitreMission AS titre,
    DescriptionMission AS description,
    DateHeureDebutMission AS start,
    DateHeureFinMission AS end,
    LieuMission AS lieu,
    CategorieMission AS categorie,
    NbBenevolesAttendusMission AS nb
  FROM Mission
";

$stmt = $pdo->query($sqlMissions);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'id'    => 'M' . $row['id'], // M = Mission
        'title' => $row['titre'],
        'start' => $row['start'],
        'end'   => $row['end'],
        'color' => '#0d6efd', // bleu
        'extendedProps' => [
            'type' => 'mission',
            'description' => $row['description'],
            'lieu' => $row['lieu'],
            'categorie' => $row['categorie'],
            'nbBenevoles' => $row['nb']
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($events);

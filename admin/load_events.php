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
    m.IdMission AS id,
    m.TitreMission AS titre,
    m.DescriptionMission AS description,
    m.DateHeureDebutMission AS start,
    m.DateHeureFinMission AS end,
    m.LieuMission AS lieu,
    m.CategorieMission AS categorie,
    m.NbBenevolesAttendusMission AS nb,
    GROUP_CONCAT(
        CONCAT(b.PrenomBenevole, ' ', b.NomBenevole)
        SEPARATOR ', '
    ) AS benevoles
  FROM Mission m
  LEFT JOIN Assigner a ON a.IdMission = m.IdMission
  LEFT JOIN Benevole b ON b.IdBenevole = a.IdBenevole
  GROUP BY m.IdMission
";

$stmt = $pdo->query($sqlMissions);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $events[] = [
        'id'    => 'M' . $row['id'],
        'title' => $row['titre'],
        'start' => $row['start'],
        'end'   => $row['end'],
        'color' => '#0d6efd',
        'extendedProps' => [
            'type' => 'mission',
            'description' => $row['description'],
            'lieu' => $row['lieu'],
            'categorie' => $row['categorie'],
            'nbBenevoles' => $row['nb'],
            'benevoles' => $row['benevoles']
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($events);

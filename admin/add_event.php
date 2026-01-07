<?php

session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $type = $_POST['type'];
    $titre = $_POST['titre'];
    $description = $_POST['description'] ;
    $date_debut = $_POST['date_debut'];
    $lieu = $_POST['lieu'] ;

    if ($type === "mission") {
        $date_fin = $_POST['date_fin'];
        $categorie = $_POST['categorie'] ?? null;
        $nb_benevoles = $_POST['nb_benevoles'] ?? null;
        $id_responsable = $_POST['id_responsable'] ;
        $id_assigne = $_POST['id_assigne'] ?? [];

        $sql="INSERT INTO Mission (TitreMission , DescriptionMission , DateHeureDebutMission ,
                    DateHeureFinMission , LieuMission , CategorieMission , NbBenevolesAttendusMission,IdResponsable)
                VALUES
                (:titre, :description, :date_debut, :date_fin, :lieu, :categorie, :nb_benevoles,:id_responsable)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':lieu' => $lieu,
            ':categorie' => $categorie,
            ':nb_benevoles' => $nb_benevoles,
            ':id_responsable' => $id_responsable
        ]);

        $idMission = $pdo->lastInsertId();

        if (!empty($id_assigne)) {
            $sqlAssign = "INSERT INTO Assigner (IdMission, IdBenevole)
                  VALUES (:idMission, :idBenevole)";

            $stmtAssign = $pdo->prepare($sqlAssign);

            foreach ($id_assigne as $idBenevole) {
                $stmtAssign->execute([
                    ':idMission' => $idMission,
                    ':idBenevole' => $idBenevole
                ]);
            }
        }


    } elseif ($type === "evenement") {
        $theme = $_POST['theme'] ?? null;
        $type_evenement = $_POST['type_evenement'] ?? null;

        $sql="INSERT INTO Evenement(TitreEvenement , DescriptionEvenement  , DateEvenement , LieuEvenement , ThemeEvenement , TypeEvenement)
                VALUES
                (:titre, :description, :date_debut, :lieu, :theme, :type_evenement)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':date_debut' => $date_debut,
            ':lieu' => $lieu,
            ':theme' => $theme,
            ':type_evenement' => $type_evenement
        ]);

    }
}

header('Content-Type: application/json');
echo json_encode(['success' => true]);


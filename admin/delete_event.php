<?php
session_start();
require_once '../config/db.php';

if ($_SESSION['role'] !== 'Admin') {
    echo "Vous n'avez pas la permission.";
    exit;
}

if (isset($_POST['id'], $_POST['type'])) {
    $idRaw = $_POST['id'];
    $id = intval(substr($idRaw, 1));
    $type = $_POST['type'];

    if ($type === 'mission') {
        $table = 'Mission';
        $id_column = 'IdMission';
    } elseif ($type === 'evenement') {
        $table = 'Evenement';
        $id_column = 'IdEvenement';
    } else {
        echo "Type invalide.";
        exit;
    }

    // On concatène le nom de colonne directement dans la requête
    $sql = "DELETE FROM $table WHERE $id_column = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo ucfirst($type) . " supprimé avec succès !";
} else {
    echo "ID ou type manquant.";
}
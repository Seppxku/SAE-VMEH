<?php

session_start();
require_once '../config/db.php';

$order_by = 'TitreMission';
$order_dir = 'ASC';

if (isset($_GET['sort'])) {
    $colonnes_autorisees = ['TitreMission', 'LieuMission', 'CatégorieMission', 'DateHeureDébutMission'];

    if (in_array($_GET['sort'], $colonnes_autorisees)) {
        $order_by = $_GET['sort'];
    }
}

if (isset($_GET['dir']) && $_GET['dir'] === 'DESC') {
    $order_dir = 'DESC';
}

$sql = "SELECT * FROM Mission ORDER BY $order_by $order_dir";
$stmt = $pdo->query($sql);
$missions = $stmt->fetchAll();

function sortLink($col, $label, $current_order, $current_dir) {
    $new_dir = ($current_order === $col && $current_dir === 'ASC') ? 'DESC' : 'ASC';
    $icon = '';
    if ($current_order === $col) {
        $icon = ($current_dir === 'ASC') ? ' <i class="fas fa-sort-up"></i>' : ' <i class="fas fa-sort-down"></i>';
    }
    return '<a href="?sort=' . $col . '&dir=' . $new_dir . '" class="text-white text-decoration-none">' . $label . $icon . '</a>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Missions - VMEH</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <?php include "../includes/sidebar.php"; ?>

    <main class="container-fluid p-4">
        <div class="container mt-4">

            <button class="btn btn-primary mb-3" id="btnAddEvent">
                ➕ Ajouter un événement / mission
            </button>

            <div id="calendar"></div>
        </div>
    </main>
</div>
<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="addEventForm">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un événement / mission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type" required>
                        <option value="mission">Mission</option>
                        <option value="evenement">Événement</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date début</label>
                    <input type="date" class="form-control" name="date_debut" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date fin</label>
                    <input type="date" class="form-control" name="date_fin">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<script src="../assets/js/calendar.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
</body>
</html>
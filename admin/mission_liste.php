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

$sqlBenevoles = "SELECT IdBenevole, NomBenevole, PrenomBenevole FROM Benevole ORDER BY NomBenevole";
$stmt = $pdo->query($sqlBenevoles);
$benevoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <?php if($_SESSION['role'] === 'Admin'): ?>
            <button class="btn btn-primary mb-3" id="btnAddEvent">
                ➕ Ajouter un événement / mission
            </button>
            <?php endif; ?>
            <div id="calendar"></div>
        </div>
    </main>
</div>
<!-- modal d'affichage des evenement -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>
</div>

<!-- form pour la creation d'evenement et de mission -->
<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="addEventForm">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une mission ou un événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- TYPE -->
                <div class="mb-3">
                    <label class="form-label d-block">Type</label>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="type" id="typeMission" value="mission" checked>
                        <label class="btn btn-outline-primary" for="typeMission">Mission</label>

                        <input type="radio" class="btn-check" name="type" id="typeEvenement" value="evenement">
                        <label class="btn btn-outline-primary" for="typeEvenement">Événement</label>
                    </div>
                </div>

                <!-- TITRE -->
                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" required>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>

                <!-- DATE DEBUT -->
                <div class="mb-3">
                    <label class="form-label">Date / Heure de début</label>
                    <input type="datetime-local" class="form-control" name="date_debut" required>
                </div>

                <!-- DATE FIN (MISSION SEULEMENT) -->
                <div class="mb-3" id="dateFinGroup">
                    <label class="form-label">Date / Heure de fin</label>
                    <input type="datetime-local" class="form-control" name="date_fin" id="dateFin">
                </div>

                <!-- LIEU -->
                <div class="mb-3">
                    <label class="form-label">Lieu</label>
                    <input type="text" class="form-control" name="lieu" required>
                </div>

                <!-- CHAMPS MISSION -->
                <div id="missionFields">
                    <div class="mb-3">
                        <label class="form-label">Catégorie de mission</label>
                        <input type="text" class="form-control" name="categorie">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre de bénévoles attendus</label>
                        <input type="number" class="form-control" name="nb_benevoles" min="1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bénévole assigné</label>
                        <select class="form-select" name="benevole_id" required>
                            <option value="">— Sélectionner un bénévole —</option>
                            <?php foreach ($benevoles as $b): ?>
                                <option value="<?= $b['IdBenevole'] ?>">
                                    <?= htmlspecialchars($b['PrenomBenevole'] . ' ' . $b['NomBenevole']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- CHAMPS EVENEMENT -->
                <div id="evenementFields" style="display:none">
                    <div class="mb-3">
                        <label class="form-label">Thème de l'événement</label>
                        <input type="text" class="form-control" name="theme">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type d'événement</label>
                        <input type="text" class="form-control" name="type_evenement">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </form>
    </div>
</div>



<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script src="../assets/js/calendar.js"></script>
</body>
</html>
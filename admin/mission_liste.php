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
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <?php include "../includes/sidebar.php"; ?>

    <main class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Gestion des Missions</h1>
            <a href="benevoles_ajouter.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Nouvelle Mission
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th><?= sortLink('TitreMission ', 'Mission ', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('LieuMission ', 'Lieu', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('CatégorieMission ', 'Catégorie', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('DateHeureDébutMission ', 'Commencer le ', $order_by, $order_dir) ?></th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($missions as $m): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($m['TitreMission']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($m['LieuMission']) ?></td>
                                <td><?= htmlspecialchars($m['CatégorieMission']) ?></td>
                                <td><?= date("d/m/Y", strtotime($m['DateHeureDébutMission'])) ?></td>

                                <td class="text-end">
                                    <a href="missions_modifier.php?id=<?= $m['IdMission '] ?>" class="btn btn-sm btn-primary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <?php if($_SESSION['role'] === 'Admin'): ?>
                                        <a href="missions_supprimer.php?id=<?= $m['IdMission '] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Supprimer cette mission définitivement ?');"
                                           title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
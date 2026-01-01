<?php

session_start();
require_once '../config/db.php';

$order_by = 'NomBenevole';
$order_dir = 'ASC';

if (isset($_GET['sort'])) {
    $colonnes_autorisees = ['NomBenevole', 'VilleBenevole', 'RoleBenevole', 'DateInscriptionBenevole'];

    if (in_array($_GET['sort'], $colonnes_autorisees)) {
        $order_by = $_GET['sort'];
    }
}

if (isset($_GET['dir']) && $_GET['dir'] === 'DESC') {
    $order_dir = 'DESC';
}

$sql = "SELECT * FROM Benevole ORDER BY $order_by $order_dir";
$stmt = $pdo->query($sql);
$benevoles = $stmt->fetchAll();

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
    <title>Liste des Bénévoles - VMEH</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <?php include "../includes/sidebar.php"; ?>

    <main class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Gestion des Bénévoles</h1>
            <a href="benevoles_ajouter.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Nouveau Bénévole
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th><?= sortLink('NomBenevole', 'Nom / Prénom', $order_by, $order_dir) ?></th>
                            <th>Email / Téléphone</th>
                            <th><?= sortLink('VilleBenevole', 'Ville', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('RoleBenevole', 'Rôle', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('DateInscriptionBenevole', 'Inscrit le', $order_by, $order_dir) ?></th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($benevoles as $b): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($b['NomBenevole']) ?></strong><br>
                                    <?= htmlspecialchars($b['PrenomBenevole']) ?>
                                </td>
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($b['MailBenevole']) ?>"><?= htmlspecialchars($b['MailBenevole']) ?></a><br>
                                    <small class="text-muted"><?= htmlspecialchars($b['TelBenevole'] ?? 'Non renseigné') ?></small>
                                </td>
                                <td><?= htmlspecialchars($b['VilleBenevole']) ?></td>
                                <td>
                                    <?php
                                    $badgeColor = match($b['RoleBenevole']) {
                                        'Admin' => 'danger',
                                        'Responsable' => 'warning text-dark',
                                        default => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $badgeColor ?>"><?= htmlspecialchars($b['RoleBenevole']) ?></span>
                                </td>
                                <td><?= date("d/m/Y", strtotime($b['DateInscriptionBenevole'])) ?></td>

                                <td class="text-end">
                                    <a href="benevoles_modifier.php?id=<?= $b['IdBenevole'] ?>" class="btn btn-sm btn-primary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <?php if($_SESSION['role'] === 'Admin'): ?>
                                        <a href="benevoles_supprimer.php?id=<?= $b['IdBenevole'] ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Supprimer ce bénévole définitivement ?');"
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
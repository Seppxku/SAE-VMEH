<?php
session_start();
require_once 'functions/auth.php';
user_connect();
require_once '../config/db.php';

$order_by = 'NomBenevole';
$order_dir = 'ASC';

if (isset($_GET['sort'])) {
    $colonnes_autorisees = ['NomBenevole', 'VilleBenevole', 'DateDeNaissanceBenevole', 'SoldeCotisation'];
    if (in_array($_GET['sort'], $colonnes_autorisees)) {
        $order_by = $_GET['sort'];
    }
}
if (isset($_GET['dir']) && $_GET['dir'] === 'DESC') {
    $order_dir = 'DESC';
}

$sql = "SELECT * FROM Benevole where EstValide = 1 ORDER BY $order_by $order_dir";
$stmt = $pdo->query($sql);
$benevoles = $stmt->fetchAll();

function sortLink($col, $label, $current_order, $current_dir) {
    $new_dir = ($current_order === $col && $current_dir === 'ASC') ? 'DESC' : 'ASC';
    $icon = '';
    if ($current_order === $col) {
        $icon = ($current_dir === 'ASC') ? ' <i class="fas fa-sort-up"></i>' : ' <i class="fas fa-sort-down"></i>';
    }
    return '<a href="?sort=' . $col . '&dir=' . $new_dir . '" class="text-white text-decoration-none fw-bold">' . $label . $icon . '</a>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Bénévoles - VMEH</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php if(file_exists("../includes/sidebar.php")) include "../includes/sidebar.php"; ?>

    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Annuaire des Bénévoles</h2>
            <span class="badge bg-primary fs-6"><?= count($benevoles) ?> inscrit(s)</span>
        </div>

        <div class="card shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark text-white">
                        <tr>
                            <th><?= sortLink('NomBenevole', 'Identité', $order_by, $order_dir) ?></th>
                            <th>Contact & Profession</th>
                            <th><?= sortLink('VilleBenevole', 'Ville', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('SoldeCotisation', 'Cotisation', $order_by, $order_dir) ?></th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($benevoles) === 0): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Aucun bénévole trouvé.</td></tr>
                        <?php endif; ?>

                        <?php foreach($benevoles as $b): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                                            <?= strtoupper(substr($b['PrenomBenevole'], 0, 1)) . strtoupper(substr($b['NomBenevole'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <strong><?= htmlspecialchars($b['NomBenevole']) ?></strong> <?= htmlspecialchars($b['PrenomBenevole']) ?>
                                            <br>D
                                            <small class="text-muted"><?= htmlspecialchars($b['RoleBenevole']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <i class="fas fa-briefcase text-muted me-1"></i> <?= htmlspecialchars($b['ProfessionBenevole'] ?? 'Non renseigné') ?>
                                    </div>
                                    <div class="small mt-1">
                                        <a href="mailto:<?= htmlspecialchars($b['MailBenevole']) ?>" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($b['MailBenevole']) ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    <?= htmlspecialchars($b['VilleBenevole']) ?>
                                </td>
                                <td>
                                    <?php
                                    $solde = floatval($b['SoldeCotisation']);
                                    if($solde < 0) {
                                        echo "<span class='badge bg-danger'>Dette : $solde €</span>";
                                    } elseif($solde > 0) {
                                        echo "<span class='badge bg-success'>+$solde €</span>";
                                    } else {
                                        echo "<span class='badge bg-secondary'>À jour</span>";
                                    }
                                    ?>
                                </td>
                                <td class="text-end">

                                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                                        <a href="benevoles_supprimer.php?id=<?= $b['IdBenevole'] ?>"
                                           class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Supprimer définitivement ce bénévole ?');" title="Supprimer">
                                            <i class="fas fa-trash"></i>
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
    </div>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
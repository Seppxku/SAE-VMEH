<?php
session_start();
require_once 'functions/auth.php';
user_connect();
require_once '../config/db.php';

$sql = "SELECT * FROM Benevole ORDER BY NomBenevole ASC";
$stmt = $pdo->query($sql);
$benevoles = $stmt->fetchAll();
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
        <h2 class="mb-4">Annuaire des Bénévoles</h2>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>Nom / Prénom</th>
                        <th>Contact</th>
                        <th>Ville</th>
                        <th>Cotisation (Solde)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($benevoles as $b): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($b['NomBenevole']) ?></strong> <?= htmlspecialchars($b['PrenomBenevole']) ?>
                                <br>
                                <small class="text-muted"><?= htmlspecialchars($b['RoleBenevole']) ?></small>
                            </td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($b['MailBenevole']) ?>"><?= htmlspecialchars($b['MailBenevole']) ?></a><br>
                                <small><?= htmlspecialchars($b['TelBenevole'] ?? '') ?></small>
                            </td>
                            <td><?= htmlspecialchars($b['VilleBenevole']) ?></td>
                            <td>
                                <?php
                                $solde = floatval($b['SoldeCotisation']);
                                if($solde < 0) {
                                    echo "<span class='badge bg-danger'>Dette : $solde €</span>";
                                } elseif($solde > 0) {
                                    echo "<span class='badge bg-success'>Avance : +$solde €</span>";
                                } else {
                                    echo "<span class='badge bg-secondary'>À jour (0 €)</span>";
                                }
                                ?>
                            </td>
                            <td class="text-end">

                                <?php if($_SESSION['role'] === 'Admin'): ?>
                                    <a href="benevoles_supprimer.php?id=<?= $b['IdBenevole'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Supprimer définitivement ce bénévole ?');">
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
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
require_once 'functions/auth.php';
user_connect();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    die("Accès refusé.");
}

if (file_exists('../config/db.php')) {
    require_once '../config/db.php';
} else {
    require_once '../db.php';
}

$msg = "";
$msgType = "";

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($_GET['action'] === 'valider') {
        $stmt = $pdo->prepare("UPDATE Benevole SET EstValide = 1 WHERE IdBenevole = ?");
        if($stmt->execute([$id])) {
            $msg = "Candidature acceptée ! Le bénévole peut maintenant se connecter.";
            $msgType = "success";
        }
    }
    elseif ($_GET['action'] === 'supprimer') {
        $stmt = $pdo->prepare("DELETE FROM Benevole WHERE IdBenevole = ?");
        if($stmt->execute([$id])) {
            $msg = "Candidature refusée et supprimée.";
            $msgType = "warning";
        }
    }
}

$sql = "SELECT * FROM Benevole WHERE EstValide = 0 ORDER BY DateInscriptionBenevole ASC";
$candidats = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Candidatures en attente - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <?php if(file_exists("../includes/sidebar.php")) include "../includes/sidebar.php"; ?>

    <div class="container-fluid p-4">
        <h2 class="mb-4 text-primary"><i class="fas fa-user-clock"></i> Candidatures en attente</h2>

        <?php if(!empty($msg)): ?>
            <div class="alert alert-<?= $msgType ?>"><?= $msg ?></div>
        <?php endif; ?>

        <?php if(empty($candidats)): ?>
            <div class="alert alert-info shadow-sm">
                <i class="fas fa-check-circle"></i> Aucune nouvelle demande pour le moment. Tout est à jour !
            </div>
        <?php else: ?>

            <div class="row">
                <?php foreach($candidats as $c): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow border-0 h-100">
                            <div class="card-header bg-dark text-white d-flex justify-content-between">
                                <span class="fw-bold"><?= htmlspecialchars($c['PrenomBenevole'] . " " . $c['NomBenevole']) ?></span>
                                <small><?= date("d/m/Y", strtotime($c['DateInscriptionBenevole'] ?? 'now')) ?></small>
                            </div>
                            <div class="card-body">
                                <p class="mb-1"><strong><i class="fas fa-envelope"></i> Email :</strong> <br><a href="mailto:<?= $c['MailBenevole'] ?>"><?= htmlspecialchars($c['MailBenevole']) ?></a></p>
                                <p class="mb-1"><strong><i class="fas fa-phone"></i> Tél :</strong> <?= htmlspecialchars($c['TelBenevole'] ?? '-') ?></p>
                                <p class="mb-1"><strong><i class="fas fa-briefcase"></i> Job :</strong> <?= htmlspecialchars($c['ProfessionBenevole'] ?? '-') ?></p>
                                <p class="mb-1"><strong><i class="fas fa-map-marker-alt"></i> Ville :</strong> <?= htmlspecialchars($c['VilleBenevole']) ?></p>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="?action=valider&id=<?= $c['IdBenevole'] ?>" class="btn btn-success fw-bold">
                                        <i class="fas fa-check"></i> ACCEPTER
                                    </a>
                                    <a href="?action=supprimer&id=<?= $c['IdBenevole'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Refuser définitivement ?')">
                                        <i class="fas fa-times"></i> Refuser
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</div>

</body>
</html>
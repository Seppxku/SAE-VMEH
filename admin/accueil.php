<?php
require_once 'functions/auth.php';
user_connect();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil - VMEH</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <?php require_once "../includes/sidebar.php"; ?>

    <main class="w-100 p-5 text-center d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div>
            <!-- Fallback image if wikipedia one blocks, but using a generic placeholder or no image is safer if internet is flaky. Keeping user's style. -->
            <h1 class="display-4 fw-bold">Bienvenue sur l'espace Administration</h1>
            <p class="lead text-muted">Gérez les bénévoles, les missions et visualisez les statistiques de l'association.</p>
            <div class="mt-4">
                <a href="dashboard.php" class="btn btn-primary btn-lg px-4 gap-3">Accéder au Dashboard</a>
                <a href="mission_liste.php" class="btn btn-outline-secondary btn-lg px-4">Gérer les Missions</a>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

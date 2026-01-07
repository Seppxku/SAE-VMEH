<?php
session_start();
require_once 'functions/auth.php';
user_connect();
require_once '../config/db.php';

$order_by = 'NomBenevole';
$order_dir = 'ASC';

if (isset($_GET['sort'])) {
    $colonnes_autorisees = [
            'NomBenevole',
            'VilleBenevole',
            'ProfessionBenevole',
            'DisponibiliteBenevole',
            'SoldeCotisation'
    ];
    if (in_array($_GET['sort'], $colonnes_autorisees)) {
        $order_by = $_GET['sort'];
    }
}
if (isset($_GET['dir']) && $_GET['dir'] === 'DESC') {
    $order_dir = 'DESC';
}

$where = [];
$params = [];

$where[] = "EstValide = 1";

if (!empty($_GET['ville'])) {
    $where[] = "VilleBenevole LIKE ?";
    $params[] = "%" . $_GET['ville'] . "%";
}

if (!empty($_GET['profession'])) {
    $where[] = "ProfessionBenevole LIKE ?";
    $params[] = "%" . $_GET['profession'] . "%";
}

if (isset($_GET['dispo']) && $_GET['dispo'] !== '') {
    $where[] = "DisponibiliteBenevole = ?";
    $params[] = $_GET['dispo'];
}

$sql_where = "WHERE " . implode(" AND ", $where);
$sql = "SELECT * FROM Benevole 
        $sql_where 
        ORDER BY $order_by $order_dir";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$benevoles = $stmt->fetchAll();

function sortLink($col, $label, $current_order, $current_dir) {
    $new_dir = ($current_order === $col && $current_dir === 'ASC') ? 'DESC' : 'ASC';

    $icon = '';
    if ($current_order === $col) {
        $icon = ($current_dir === 'ASC') ? ' <i class="fas fa-sort-up"></i>' : ' <i class="fas fa-sort-down"></i>';
    }

    $params = $_GET;
    $params['sort'] = $col;
    $params['dir'] = $new_dir;

    return '<a href="?' . http_build_query($params) . '" class="text-white text-decoration-none fw-bold">' . $label . $icon . '</a>';
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

    <div class="container-fluid p-4 w-100">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Annuaire des Bénévoles</h2>
            <span class="badge bg-primary fs-6"><?= count($benevoles) ?> trouvé(s)</span>
        </div>

        <div class="card shadow mb-4 border-primary">
            <div class="card-header bg-light fw-bold text-primary">
                <i class="fas fa-filter me-2"></i>Filtrer les bénévoles
            </div>
            <div class="card-body bg-white">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Ville</label>
                        <input type="text" name="ville" class="form-control form-control-sm" placeholder="Ex: Paris" value="<?= htmlspecialchars($_GET['ville'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Profession</label>
                        <input type="text" name="profession" class="form-control form-control-sm" placeholder="Ex: Comptable" value="<?= htmlspecialchars($_GET['profession'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Disponibilité</label>
                        <select name="dispo" class="form-select form-select-sm">
                            <option value="">-- Tout --</option>
                            <option value="1" <?= (isset($_GET['dispo']) && $_GET['dispo'] === '1') ? 'selected' : '' ?>>✅ Disponible</option>
                            <option value="0" <?= (isset($_GET['dispo']) && $_GET['dispo'] === '0') ? 'selected' : '' ?>>❌ Indisponible</option>
                        </select>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <a href="benevole_liste.php" class="btn btn-outline-secondary btn-sm me-2"><i class="fas fa-undo"></i> Réinitialiser</a>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Rechercher</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">

                        <thead class="table-dark text-white">
                        <tr>
                            <th><?= sortLink('NomBenevole', 'Identité', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('ProfessionBenevole', 'Contact & Profession', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('VilleBenevole', 'Ville', $order_by, $order_dir) ?></th>
                            <th><?= sortLink('SoldeCotisation', 'Cotisation', $order_by, $order_dir) ?></th>
                            <th class="text-center"><?= sortLink('DisponibiliteBenevole', 'Dispo', $order_by, $order_dir) ?></th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (count($benevoles) === 0): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Aucun bénévole trouvé avec ces critères.</td></tr>
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
                                            <br>
                                            <small class="text-muted"><?= htmlspecialchars($b['RoleBenevole']) ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="small"><i class="fas fa-briefcase text-muted me-1"></i> <?= htmlspecialchars($b['ProfessionBenevole'] ?? 'Non renseigné') ?></div>
                                    <div class="small mt-1"><a href="mailto:<?= htmlspecialchars($b['MailBenevole']) ?>" class="text-decoration-none"><i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($b['MailBenevole']) ?></a></div>
                                </td>

                                <td><i class="fas fa-map-marker-alt text-danger me-1"></i> <?= htmlspecialchars($b['VilleBenevole']) ?></td>

                                <td>
                                    <?php
                                    $isMe = (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $b['IdBenevole']);
                                    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin');

                                    if ($isAdmin || $isMe) {
                                        $solde = floatval($b['SoldeCotisation']);
                                        if($solde < 0) echo "<span class='badge bg-danger'>Dette : $solde €</span>";
                                        elseif($solde > 0) echo "<span class='badge bg-success'>+$solde €</span>";
                                        else echo "<span class='badge bg-secondary'>À jour</span>";
                                    } else {
                                        echo "<span class='text-muted small'><i class='fas fa-lock'></i> Privé</span>";
                                    }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <?php if ($b['DisponibiliteBenevole'] == 1): ?>
                                        <span class="badge bg-success"><i class="fas fa-check"></i> Disponible</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><i class="fas fa-times"></i> Indisponible</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-end">
                                    <?php if ($isAdmin || $isMe): ?>
                                        <a href="profil_voir.php?id=<?= $b['IdBenevole'] ?>" class="btn btn-outline-primary btn-sm me-1"><i class="fas fa-eye"></i></a>
                                    <?php endif; ?>

                                    <?php if($isAdmin): ?>
                                        <a href="benevoles_supprimer.php?id=<?= $b['IdBenevole'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer définitivement ?');"><i class="fas fa-trash"></i></a>
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
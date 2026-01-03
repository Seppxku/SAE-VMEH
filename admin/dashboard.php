<?php
session_start();
require_once 'functions/auth.php';
require_once '../config/db.php';

user_connect();

// --- 1. KPIs ---

// Nombre total de bénévoles
$stmt = $pdo->query("SELECT COUNT(*) FROM Benevole");
$nbBenevoles = $stmt->fetchColumn();

// Missions réalisées (Date fin passée)
$stmt = $pdo->query("SELECT COUNT(*) FROM Mission WHERE DateHeureFinMission < NOW()");
$nbMissions = $stmt->fetchColumn();

// Nouveaux inscrits (ce mois-ci)
$stmt = $pdo->query("SELECT COUNT(*) FROM Benevole WHERE MONTH(DateInscriptionBenevole) = MONTH(CURRENT_DATE()) AND YEAR(DateInscriptionBenevole) = YEAR(CURRENT_DATE())");
$nbNouveaux = $stmt->fetchColumn();

// Montant total des dons
$stmt = $pdo->query("SELECT SUM(MontantDon) FROM Don");
$totalDons = $stmt->fetchColumn() ?: 0;

// Taux de participation (Bénévoles ayant au moins une mission assignée)
$stmt = $pdo->query("SELECT COUNT(DISTINCT IdBenevole) FROM Assigner");
$nbParticipating = $stmt->fetchColumn();
$nbNonParticipating = $nbBenevoles - $nbParticipating;
$tauxParticipation = $nbBenevoles > 0 ? round(($nbParticipating / $nbBenevoles) * 100, 1) : 0;

// --- 2. Data for Charts ---

// Répartition par Age (Calculated from DateDeNaissanceBenevole)
// Ranges: <18, 18-35, 36-50, 51-65, >65
$sqlAge = "
    SELECT 
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, DateDeNaissanceBenevole, CURDATE()) < 18 THEN '< 18 ans'
            WHEN TIMESTAMPDIFF(YEAR, DateDeNaissanceBenevole, CURDATE()) BETWEEN 18 AND 35 THEN '18-35 ans'
            WHEN TIMESTAMPDIFF(YEAR, DateDeNaissanceBenevole, CURDATE()) BETWEEN 36 AND 50 THEN '36-50 ans'
            WHEN TIMESTAMPDIFF(YEAR, DateDeNaissanceBenevole, CURDATE()) BETWEEN 51 AND 65 THEN '51-65 ans'
            ELSE '> 65 ans'
        END as age_range,
        COUNT(*) as count
    FROM Benevole
    GROUP BY age_range
";
$ageData = $pdo->query($sqlAge)->fetchAll(PDO::FETCH_KEY_PAIR);

// Répartition par Origine Géographique
$sqlOrigine = "SELECT OrigineGeographiqueBenevole, COUNT(*) as count FROM Benevole WHERE OrigineGeographiqueBenevole IS NOT NULL AND OrigineGeographiqueBenevole != '' GROUP BY OrigineGeographiqueBenevole ORDER BY count DESC LIMIT 5";
$origineData = $pdo->query($sqlOrigine)->fetchAll(PDO::FETCH_KEY_PAIR);

// Professions (Top 5)
$sqlProf = "SELECT ProfessionBenevole, COUNT(*) as count FROM Benevole WHERE ProfessionBenevole IS NOT NULL AND ProfessionBenevole != '' GROUP BY ProfessionBenevole ORDER BY count DESC LIMIT 5";
$profData = $pdo->query($sqlProf)->fetchAll(PDO::FETCH_KEY_PAIR);

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de Bord - VMEH</title>
    
    <!-- Bootstrap & CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background-color: white !important;
            }
            
            /* Hide non-essential elements */
            .sidebar, .btn-print, header, .navbar, .no-print {
                display: none !important;
            }

            /* Adjust Main Container */
            main {
                margin: 0 !important;
                padding: 10px !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Force Grid Layout for Print - mimics col-6 behavior */
            .row {
                display: flex !important;
                flex-wrap: wrap !important;
            }
            
            /* Force 4 columns per row for KPIs and Charts to fit 8 items on one page if possible, 
               or at least 2 per row to save space. Let's try 4 items per row (25%) */
            .col-xl-3, .col-md-6 {
                flex: 0 0 25% !important;
                max-width: 25% !important;
                width: 25% !important;
                padding: 10px !important;
            }
            
            /* Reduce card separation and shadow */
            .card {
                border: 1px solid #ccc !important;
                box-shadow: none !important;
                break-inside: avoid;
            }
            
            /* Adjust Chart Size for Print */
            canvas {
                max-height: 200px !important; 
                width: 100% !important;
            }
            
            /* Ensure text is black */
            body, h1, h2, h3, h4, h5, p {
                color: #000 !important;
            }
            .text-white {
                color: #fff !important; /* Keep white text on colored cards if backgrounds print */
            }
        }
        .card-header {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar (Hidden on print) -->
    <div class="sidebar no-print d-flex">
        <?php require_once "../includes/sidebar.php"; ?>
    </div>

    <main class="flex-grow-1 p-4">
        <div class="container-fluid">
            <h1 class="h3 mb-5 text-center">Tableau de Bord</h1>

            <!-- Unified Gallery Grid -->
            <div class="row g-4 mb-5">
                
                <!-- KPI 1: Adherents -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card text-white bg-primary shadow-sm h-100" style="min-height: 300px;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                            <h5 class="card-title">Nombre d'Adhérents</h5>
                            <p class="card-text display-6 fw-bold my-3"><?= $nbBenevoles ?></p>
                            <small>Total inscrits</small>
                        </div>
                    </div>
                </div>

                <!-- KPI 2: Missions -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card text-white bg-success shadow-sm h-100" style="min-height: 300px;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                            <h5 class="card-title">Missions Réalisées</h5>
                            <p class="card-text display-6 fw-bold my-3"><?= $nbMissions ?></p>
                            <small>Depuis le début de l'année</small>
                        </div>
                    </div>
                </div>

                <!-- KPI 3: Nouveaux -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card text-dark bg-warning shadow-sm h-100" style="min-height: 300px;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                            <h5 class="card-title">Nouveaux Inscrits</h5>
                            <p class="card-text display-6 fw-bold my-3"><?= $nbNouveaux ?></p>
                            <small>Ce mois-ci</small>
                        </div>
                    </div>
                </div>

                <!-- KPI 4: Dons & Cotisations -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card text-white bg-info shadow-sm h-100" style="min-height: 300px;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">
                            <h5 class="card-title">Dons et Cotisations</h5>
                            <p class="card-text display-6 fw-bold my-3"><?= number_format($totalDons, 0, ',', ' ') ?> €</p>
                            <small>Total cumulé</small>
                        </div>
                    </div>
                </div>

                <!-- Chart: Taux de Participation -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white text-center border-0 pt-3"><strong>Taux de Participation</strong></div>
                        <div class="card-body d-flex align-items-center justify-content-center p-2">
                             <div style="width: 100%; height: 300px;">
                                <canvas id="participationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart 1: Age -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white text-center border-0 pt-3"><strong>Répartition par Âge</strong></div>
                        <div class="card-body d-flex align-items-center justify-content-center p-2">
                            <div style="width: 100%; height: 300px;">
                                <canvas id="ageChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Origine -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white text-center border-0 pt-3"><strong>Origine Géographique</strong></div>
                        <div class="card-body d-flex align-items-center justify-content-center p-2">
                            <div style="width: 100%; height: 300px;">
                                <canvas id="origineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart 3: Professions -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white text-center border-0 pt-3"><strong>Professions</strong></div>
                        <div class="card-body d-flex align-items-center justify-content-center p-2">
                            <div style="width: 100%; height: 300px;">
                                <canvas id="profChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="d-flex justify-content-center mb-5 pt-5 btn-print">
                <button onclick="window.print()" class="btn btn-outline-primary btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-2" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                    </svg>
                    Exporter PDF
                </button>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script>
    // Data injection from PHP
    const ageLabels = <?= json_encode(array_keys($ageData)); ?>;
    const ageValues = <?= json_encode(array_values($ageData)); ?>;

    const profLabels = <?= json_encode(array_keys($profData)); ?>;
    const profValues = <?= json_encode(array_values($profData)); ?>;

    const origineLabels = <?= json_encode(array_keys($origineData)); ?>;
    const origineValues = <?= json_encode(array_values($origineData)); ?>;

    const participationValues = [<?= $nbParticipating ?>, <?= $nbNonParticipating ?>];

    // --- Charts Configuration ---

    // 1. Age (Bar Chart)
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Nombre de bénévoles',
                data: ageValues,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // 2. Origine (Bar Chart - Vertical)
    new Chart(document.getElementById('origineChart'), {
        type: 'bar',
        data: {
            labels: origineLabels,
            datasets: [{
                label: 'Bénévoles',
                data: origineValues,
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // 3. Participation (Doughnut)
    new Chart(document.getElementById('participationChart'), {
        type: 'doughnut',
        data: {
            labels: ['Avec mission', 'Sans mission'],
            datasets: [{
                data: participationValues,
                backgroundColor: [
                    '#28a745', '#e9ecef' 
                ],
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // 4. Professions (Horizontal Bar)
    new Chart(document.getElementById('profChart'), {
        type: 'bar',
        data: {
            labels: profLabels,
            datasets: [{
                label: 'Bénévoles',
                data: profValues,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

</script>

</body>
</html>

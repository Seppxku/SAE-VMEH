<?php
session_start();
require_once '../config/db.php';
require_once 'functions/auth.php';

user_connect();


if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

$idBenevole = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM Benevole WHERE IdBenevole = :id");
$stmt->execute([':id' => $idBenevole]);
$benevole = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$benevole) {
    die("Bénévole introuvable");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* Changement nom / prénom */
    if (isset($_POST['changeNom'], $_POST['changePrenom'])) {
        $stmt = $pdo->prepare("
            UPDATE Benevole
            SET NomBenevole = :nom,
                PrenomBenevole = :prenom
            WHERE IdBenevole = :id
        ");
        $stmt->execute([
                ':nom' => $_POST['changeNom'],
                ':prenom' => $_POST['changePrenom'],
                ':id' => $idBenevole
        ]);
    }

    /* Changement infos personnelles */
    if (isset($_POST['changeDateNais'], $_POST['changeVille'])) {
        $stmt = $pdo->prepare("
            UPDATE Benevole
            SET DateDeNaissanceBenevole = :dateN,
                VilleBenevole = :ville
            WHERE IdBenevole = :id
        ");
        $stmt->execute([
                ':dateN' => $_POST['changeDateNais'],
                ':ville' => $_POST['changeVille'],
                ':id' => $idBenevole
        ]);
    }

    /* Changement mot de passe */
    if (!empty($_POST['changeOldMdp']) && !empty($_POST['changeMdp']) && !empty($_POST['changeMdpConfirm'])) {

        if ($_POST['changeMdp'] === $_POST['changeMdpConfirm']) {

            $stmt = $pdo->prepare("SELECT MotDePasseBenevole FROM Benevole WHERE IdBenevole = :id");
            $stmt->execute([':id' => $idBenevole]);
            $hash = $stmt->fetchColumn();

            if (password_verify($_POST['changeOldMdp'], $hash)) {
                $newHash = password_hash($_POST['changeMdp'], PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("
                    UPDATE Benevole
                    SET MotDePasseBenevole = :mdp
                    WHERE IdBenevole = :id
                ");
                $stmt->execute([
                        ':mdp' => $newHash,
                        ':id' => $idBenevole
                ]);
            }
        }
    }

    // Recharge les données après update
    header("Location: parametre.php");
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>

<body>
<div class="d-flex">

    <div class="sidebar no-print d-flex">
        <?php require_once "../includes/sidebar.php"; ?>
    </div>

    <main class="w-100 p-5 text-center d-flex align-items-center justify-content-center">
        <div>

            <!-- Nom / Prénom -->
            <form class="form-changement" method="post">
                <h3>Changer de nom & prénom</h3>
                <div>
                    <input type="text" name="changeNom"
                           value="<?= htmlspecialchars($benevole['NomBenevole']) ?>"
                           placeholder="Nouveau nom">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
                <div>
                    <input type="text" name="changePrenom"
                           value="<?= htmlspecialchars($benevole['PrenomBenevole']) ?>"
                           placeholder="Nouveau prénom">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>

            <!-- Mot de passe -->
            <form class="form-changement" method="post">
                <h3>Changer de mot de passe</h3>
                <div id="mdpChangement">
                    <input type="password" name="changeOldMdp" placeholder="Ancien mot de passe">
                    <input type="password" name="changeMdp" placeholder="Nouveau mot de passe">
                    <input type="password" name="changeMdpConfirm" placeholder="Confirmer mot de passe">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>

            <!-- Infos personnelles -->
            <form class="form-changement" method="post">
                <h3>Information personnelle</h3>
                <div>
                    <input type="date" name="changeDateNais"
                           value="<?= $benevole['DateDeNaissanceBenevole'] ?>">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
                <div>
                    <input type="text" name="changeVille"
                           value="<?= htmlspecialchars($benevole['VilleBenevole']) ?>"
                           placeholder="Ville">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>

        </div>
    </main>
</div>
</body>
</html>

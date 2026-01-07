<?php
session_start();
require_once 'functions/auth.php';
require_once '../config/db.php';

user_connect();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
$nom = $_POST['changeNom'];
$prenom = $_POST['changePrenom'];

$mdp = $_POST['changeMdp'];
$mdpOld = $_SESSION['changeOldMdp'];
$mdpConfirm = $_SESSION['changeMdpConfirm'];




}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>


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
            <form class="form-changement" action="" method="post">
                <h3>Changer de nom & prenom</h3>
                <div>
                    <input  type="text" name="changeNom" placeholder="Nouveau nom">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
                <div>
                    <input  type="text" name="changePrenom" placeholder="Nouveau Prenom">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>
            <form class="form-changement" action="" method="post">
                <h3>Changer de mot de passe</h3>
                <div id="mdpChangement">
                    <input  type="password" name="changeOldMdp " placeholder="Ancien Mot de passe">
                    <input  type="password" name="changeMdp " placeholder="Nouveau Mot de passe">
                    <input  type="password" name="changeMdpConfirm " placeholder="Confirmer Mot de passe">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>
            <form class="form-changement" action="" method="post">
                <h3>Information personnelle</h3>
                <div>
                    <input  type="Date" name="changeDateNais " placeholder="Date de Naissance">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
                <div>
                    <input  type="text" name="ChangeVille " placeholder="Ville">
                    <button class="btn-submit" type="submit">Changer</button>
                </div>
            </form>
        </div>
    </main>
</div>











</body>
</html>

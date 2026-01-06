<?php
session_start();
require_once 'functions/auth.php';
user_connect();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    die("Accès refusé : Vous n'avez pas les droits administrateur.");
}

if (file_exists('../config/db.php')) {
    require_once '../config/db.php';
} else {
    require_once '../db.php';
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id == $_SESSION['user_id']) {
        echo "<script>alert('Impossible de supprimer votre propre compte !'); window.location.href='benevole_liste.php';</script>";
        exit();
    }

    $stmt = $pdo->prepare("DELETE FROM Benevole WHERE IdBenevole = ?");
    $stmt->execute([$id]);
}

header("Location: benevole_liste.php");
exit();
?>
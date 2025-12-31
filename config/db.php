<?php
$host = 'mysql-sae-vmeh.alwaysdata.net';
$dbname = 'sae-vmeh_bd';
$user = 'sae-vmeh';
$password = 'j9nXanN5VsY7U6C';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}






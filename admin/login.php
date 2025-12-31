<?php
session_start();
require_once '../config/db.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['motdepasse'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM Benevole WHERE MailBenevole = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['MotDePasse'])) {
            $_SESSION['user_id'] = $user['IdBenevole'];
            $_SESSION['role'] = $user['RoleBenevole'];
            $_SESSION['prenom'] = $user['PrenomBenevole'];

            header('Location: dashboard.php');
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <link href="../assets/css/admin.css" rel="stylesheet">
    <title>VMEH</title>
</head>
<?php require_once "../includes/header.php"; ?>
<body>
<div class="form-login">
    <form class="left"  action="" method="post">
        <h2>Connectez-vous à l'espace réservé VMEH</h2>
        <div class="form-item">
            <input class="form-input form-control" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-item" >
            <input class="form-input form-control" type="password" name="motdepasse" placeholder="Mot de passe">

        </div>
        <div class="form-item" >
            <button class="form-item form-control " id="btn-submit" type="submit">Se connecter</button>
            <a href="#" >Créer un compte</a>

        </div>

    </form>
    <div class="right" >
        <img src="../assets/image/navbar/ducoeur.webp"
             alt="Du coeur et beaucoup d'écoute écrit sur un fil noir qui se déroule d'un coeur vibrant de couleurs rouges, jaunes et oranges"
             class="img-fluid"
        >
    </div>
</div>

</body>
<?php require_once "../includes/footer.php"; ?>


</html>


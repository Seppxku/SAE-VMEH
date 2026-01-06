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

            if ($user['EstValide'] == 0) {
                $error = "Votre compte est en attente de validation par un administrateur.";
            } else {

                $_SESSION['user_id'] = $user['IdBenevole'];
                $_SESSION['nom'] = $user['PrenomBenevole'] . " " . $user['NomBenevole'];
                $_SESSION['role'] = $user['RoleBenevole'];

                header("Location: accueil.php");
                exit();
            }
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


<header>
    <nav class="navbar navbar-expand-xl">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/image/navbar/VMEH_Logo.webp"
                     alt="Main verte qui soutient un coeur avec deux personnes à l'intérieur qui semblent s'entraider.
                     Il y a en dessous écrit VMEH en noir suivi de la description de l'acronyme"
                     height="100"
                     width="150">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            L'ASSOCIATION
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../public/histoire.php">HISTOIRE</a></li>
                            <li><a class="dropdown-item" href="#">MISSIONS ET VALEURS</a></li>
                            <li><a class="dropdown-item" href="#">NOTRE ORGANISATION</a></li>
                            <li><a class="dropdown-item" href="../public/association-departementale.php">NOS ASSOCIATIONS DÉPARTEMENTALES</a></li>
                            <li><a class="dropdown-item" href="#">NOS PARTENAIRES</a></li>
                            <li><a class="dropdown-item" href="#">NOTRE DOCUMENTATION</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="../public/actualite.php" role="button" >
                            ACTUALITÉS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../public/devenir-benevole.php">DEVENIR BÉNÉVOLE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">NOS ACTIONS</a>
                    </li>

                </ul>
                <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">
                    <a class="btn rounded-pill d-flex align-items-center text-start gap-2 px-3 px-lg-4 py-2" id="espace-membre" href="login.php">
                        <img src="../assets/image/navbar/photo-profil-utiisateur.webp" alt="" height="30"
                             width="30">Espace <br>membre
                    </a>
                    <a class="btn rounded-pill d-flex align-items-center text-start gap-2 text-white px-3 px-lg-4 py-2" id="faire-un-don" href="#">
                        <img src="../assets/image/navbar/White-Heart-Emoji-PNG.webp"
                             alt=""
                             height="30"
                             width="30"
                        >Faire un <br>don
                    </a>
                </div>
            </div>
        </div>
    </nav>


</header>
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
            <a href="../public/devenir-benevole.php#comment-devenir-benevole" >Créer un compte</a>

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
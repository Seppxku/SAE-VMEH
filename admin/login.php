
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

<?php
//TODO faire la connection avec la bdd

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['motdepasse'];

    if($email != "" || $password != ""){
        $token = bin2hex(random_bytes(32));

        //$req = $bdd->prepare("SELECT * FROM users WHERE email = :email and mdp = :motdepasse");
        //$rep = $req->fetch()
        //TODO verifier si il est dans la bdd

        //$bdd->exec("UPDATE users SET token = '$token' WHERE email = '$email' and  motdepasse = '$password'");
        setcookie("token", $token, time() + 3600);
        setcookie("username", $email, time() + 3600);

        header('Location: dashboard.php');
        exit();
    }
}



?>
<?php require_once "../pages/header.php"; ?>
<body>

<form  class="form-control"  action="" method="post">
    <div class="form-login">
        <input class="form-control" type="email" name="email" placeholder="Email">
    </div>
    <div class="form-login">
        <input class="form-control" type="password" name="motdepasse" placeholder="Mot de passe">
    </div>
    <button class="form-control"  type="submit">Se connecter</button>
</form>
</body>
<?php require_once "../pages/footer.php"; ?>


</html>


<?php
session_start();
require_once 'class/Autoloader.class.php';
Autoloader::register();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>
<body>

    <div class="container" onclick()>
      <div class="top">
      <div class="bottom">
        <form action="" method="post">
        <div class="center">
          <h2> Connectez vous</h2>
          <input type="text" required name="login" id="" placeholder="login">
          <input type="password" required name="password" id="" placeholder="password">
          <input type="submit" value="connexion" name="connexion">
          <h2> &nbsp </h2>;
          </div>
        </form>
        </div>
    </div>
    </div>
    <?php
if (isset($_POST['connexion'])) {
    $log = $_POST['login'];
    $mdp = $_POST['password'];
    //parcours
    Database::connect();
    $ok = User::connexion($log, $mdp);
    if ($ok) {
        header("location:./pages/acceuil.php");
    }else{
        echo "Login ou Mot de passe incorrect";
    }

}
?>
    ?>
</body>
</html>
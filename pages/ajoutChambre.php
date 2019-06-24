<?php
if (empty($_SESSION)) {
    session_start();
    if (!isset($_SESSION['profil'])) {
        header("location:../index.php");
    }else{
        require_once '../class/Autoloader.class.php';
        Autoloader::register();
    }
} else {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleMenu.css">
      <link rel="stylesheet" href="../css/styleAcceuil.css">
    <title>Ajout Chambre</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <div class="container-fluid marge text-center">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="titre">AJOUT CHAMBRE</h1>
            </div>
        </div>
    <form action="" method="POST">
        <div class="row">
            <div class="input-group mb-3 col-12 offset-md-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ol"></i></span>
                </div>
                <input type="number" min=1 name="num" class="form-control" required placeholder="Entrer le Numero de Chambre">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12 offset-md-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bed"></i></span>
                </div>
                <input type="text" name="nom" class="form-control" required placeholder="Entrer le Nom">
            </div>
        </div>
        <div class="row">
                <div class="input-group mb-3 col-12 offset-md-3 col-md-6">
                    <div class="input-group-append">
                        <label class="input-group-text" for="bat"><i class="far fa-building"></i></label>
                    </div>
                    <select class="custom-select" name="bat" id="bat">
                        <option selected>Choisir un Batiment</option>
                        <?php
                            Database::connect();
                            $retour=RequetesChambre::selectBat();
                            while($data=$retour->fetch()){
                                echo "<option value=".$data['idBat'].">".$data['nomBat']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        <button type="submit" name="ajouter" class="btn btn-primary">Submit</button>
    </form>
    <?php
        if(isset($_POST['ajouter'])){
            $nom=$_POST['nom'];
            $num=$_POST['num'];
            $bat=$_POST['bat'];
            $chambre=new Chambre($num,$nom,$bat);
            $chambre->add($chambre);
        }
    ?>
    </div>

    
    <script src="../js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
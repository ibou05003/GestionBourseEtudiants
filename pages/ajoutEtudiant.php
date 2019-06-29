<?php
if (empty($_SESSION)) {
    session_start();
    if (!isset($_SESSION['profil'])) {
        header("location:../index.php");
    } else {
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
    
      <link rel="stylesheet" href="../css/styleAcceuil.css">
      <link rel="stylesheet" href="../css/fond.css">
    <title>Ajout Etudiant</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <div class="container-fluid marge text-center">
        <div class="formulaire">

        
        <div class="row text-center">
            <div class="col-12">
                <h1 class="titre">AJOUT ETUDIANT</h1>
            </div>
        </div>
        <div id="erreur">
            <p>Vous n'avez pas rempli correctement les champs du formulaire !</p>
        </div>
    <form action="" method="POST">
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="nom" name="nom" class="form-control champ" value="<?php if(isset($_POST['nom'])) echo $_POST['nom'] ?>" placeholder="Entrer le Nom">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="prenom" name="prenom" class="form-control champ" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom'] ?>" placeholder="Entrer le Prenom">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" id="mail" name="mail" class="form-control" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>" placeholder="Entrer Email">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                </div>
                <input type="number" id="tel" name="tel" min=300000000 value="<?php if(isset($_POST['tel'])) echo $_POST['tel'] ?>" class="form-control champ" placeholder="Entrer le Numéro de Téléphone">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" id="dateNaiss" max= <?php echo date('Y-m-d'); ?> name="dateNaiss" class="form-control" value="<?php if(isset($_POST['dateNaiss'])) echo $_POST['dateNaiss'] ?>" placeholder="Entrer Date de Naissance">
                
            </div>
            <span id="age">L'âge doit être compris entre 18 et 30 ans </span>
        </div>
        <div class="row">
            
            <div class="col-12 col-md-6">
                <div class="form-check">
<input class="form-check-input" type="radio" <?php if(isset($_POST['bourse'])&&$_POST['bourse']=='Boursier') { ?>checked <?php } ?> name="bourse" id="boursier" value="Boursier">
                    <label class="form-check-label" for="boursier">
                        Boursier
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" <?php if(isset($_POST['bourse'])&&$_POST['bourse']=='NonBoursier') { ?>checked <?php } ?> name="bourse" id="nonboursier" value="NonBoursier">
                    <label class="form-check-label" for="nonboursier">
                        Non Boursier
                    </label>
                </div>
            </div>
            <span id="choixBourse">Vous devez choisir un type !</span>
        </div>
        <div class="cacher" id="cacher">
            <div class="row">
                    <div class="input-group mb-3 col-12 col-md-6" id="afficheBoursier">
                        <div class="input-group-append">
                            <label class="input-group-text" for="typeBourse"><i class="fas fa-coins"></i></label>
                        </div>
                        <select class="custom-select" id="typeBourse" name="typeBourse">
                            <option value="0">Choisir une Bourse</option>
                            <?php
                                Database::connect();
                                $retour = TypeBourse::selectType();
                                while ($data = $retour->fetch()) {
                                    echo "<option value=" . $data['idType'] . ">" . $data['libelle'] . " - montant : " . $data['montant'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <span id="montant">Selectionnez un type de bourse </span>
                    <div class="input-group mb-3 col-12 col-md-6" id="afficheNonBoursier">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" id="adresse" name="adresse" class="form-control champ" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse'] ?>" placeholder="Entrer l'adresse">
                    </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6" id="afficheLoger">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?php if(isset($_POST['loger'])&&$_POST['loger']=='Loger') { ?>checked <?php } ?>  name="loger" value="Loger" id="loger">
                        <label class="form-check-label" for="loger">
                            Logé
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6" id="afficheBatiment">
                    <div class="input-group-append">
                        <label class="input-group-text" for="batiment"><i class="far fa-building"></i></label>
                    </div>
                   
                        <?php
                        Database::connect();
                            $batiments = RequetesChambre::selectBat();
                            $chambres=Database::$base->query('SELECT * FROM chambre ORDER BY idBat ASC');
                            $chambresParBat=array();
                            while($chambre=$chambres->fetch()){
                                $chambresParBat[$chambre['idBat']][$chambre['idChambre']]=$chambre['nomChambre']." - n° ".$chambre['num'];
                            }
                            ?>
                         <select class="custom-select" name="batiment" id="batiment">
                         <option value="0">Choisir Un Batiment</option>
                        <?php
                            
                            while ($data = $batiments->fetch()) {
                                echo "<option value=" . $data['idBat'] . ">" . $data['nomBat'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row" id="afficheChambre">
                <div class="input-group mb-3 col-12 col-md-6" id="AChambre">
                    
                    
                        <?php
                        
                           foreach ($chambresParBat as $idBat=>$chambres) { 
                        ?>
                        <div class="input-group" id="batiment-<?= $idBat; ?>">
                            <div class="input-group-append">
                            <label class="input-group-text" for="test"><i class="fas fa-bed"></i></label>
                             </div>
                            <select class="custom-select" name="chambre" id="chambre">;
                            <?php
                                foreach ($chambres as $idChambre => $num) {
                                    echo "<option value=" . $idChambre . ">" . $num . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                            <?php
                           }
                        ?>
                    
                </div>
            </div>
        </div>
        <button type="submit" name="ajouter" id="ajouter" class="btn btn-primary">Ajouter</button>
    </form>
    <?php
if (isset($_POST['ajouter'])) {
    //var_dump($_POST['chambre']);
    // $nom = $_POST['nom'];
    // $prenom = $_POST['prenom'];
    // $mail = $_POST['mail'];
    // $tel = $_POST['tel'];
    // $datenaiss = $_POST['dateNaiss'];
    // $bourse = $_POST['bourse'];
    // $matricule = RequetesEtudiant::genereMatricule($nom, $prenom);
    // if (isset($_POST['typeBourse'])) {
    //     $type = $_POST['typeBourse'];
    // }

    // if (isset($_POST['adresse'])) {
    //     $adresse = $_POST['adresse'];
    // }

    // if (isset($_POST['loger'])) {
    //     $loger = $_POST['loger'];
    //     if ($loger == "Loger") {
    //         if (isset($_POST['chambre'])) {
    //             $chambre = $_POST['chambre'];
    //             $typeB = RequetesEtudiant::genereType($type);
    //             $etudiant = new Loger($matricule, $nom, $prenom, $mail, $tel, $datenaiss, $typeB, $chambre);
    //         }
    //     }
    // }

    // //instanciation
    // //$et=new EtudiantService();
    // elseif ($bourse == "Boursier") {
    //     $typeB = RequetesEtudiant::genereType($type);
    //     $etudiant = new Boursier($matricule, $nom, $prenom, $mail, $tel, $datenaiss, $typeB);
    // } elseif ($bourse == "NonBoursier") {
    //     $etudiant = new NonBoursier($matricule, $nom, $prenom, $mail, $tel, $datenaiss, $adresse);
    // }
    // EtudiantService::add($etudiant);
}
?>
    </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/form.js"></script>
</body>
</html>
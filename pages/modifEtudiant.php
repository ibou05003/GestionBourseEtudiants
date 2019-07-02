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
    <title>Modifier Etudiant</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <div class="container-fluid marge text-center">
    <div class="formulaire">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="titre">Modifier Etudiant</h1>
            </div>
        </div>
        <form class="form-inline col-12 offset-md-2 col-md-8" action="" method="POST">
            <div class="input-group mb-3 col-12 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control mr-sm-3" name="recherche" type="search" value="<?php if (isset($_POST['recherche'])) {
    echo $_POST['recherche'];
}
?>" required placeholder="Entrer un Matricule">
                <button class="btn btn-outline-success my-2 my-sm-0" name="valider" type="submit">Search</button>
            </div>
        </form>
        <div class="container">
            <!-- <div class="row"> -->
            <?php
if (isset($_POST['recherche'])) {
    Database::connect();
    //EtudiantService::modifEtudiant($_POST['recherche']);
    $recherche = $_POST['recherche'];
    $requete1 = "SELECT DISTINCT * FROM etudiant,boursier,typeBourse,loger,chambre,batiment WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND boursier.idType=typeBourse.idType AND loger.idchambre=chambre.idChambre AND chambre.idBat=batiment.idBat AND etudiant.matEtudiant=?";
    $requete2 = "SELECT DISTINCT * FROM etudiant,boursier,typeBourse WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idType=typeBourse.idType AND etudiant.matEtudiant=?";
    $requete3 = "SELECT DISTINCT * FROM etudiant,nonBoursier WHERE etudiant.idEtudiant=nonBoursier.idEtudiant AND etudiant.matEtudiant=?";
    $requete4 = "SELECT DISTINCT * FROM etudiant,boursier,typeBourse WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idType=typeBourse.idType AND etudiant.matEtudiant=? AND NOT EXISTS (SELECT DISTINCT * FROM etudiant,boursier,loger WHERE etudiant.idEtudiant=boursier.idEtudiant AND boursier.idEtudiant=loger.idEtudiant AND etudiant.matEtudiant=?)";
    $req1 = Database::executeUpdate1($requete1, array($recherche));
    $req2 = Database::executeUpdate1($requete2, array($recherche));
    $req3 = Database::executeUpdate1($requete3, array($recherche));
    $req4 = Database::executeUpdate1($requete4, array($recherche, $recherche));

    $nb1 = $req1->rowCount();
    $nb2 = $req2->rowCount();
    $nb3 = $req3->rowCount();
    $nb4 = $req4->rowCount();
    if ($nb1 != 0 || $nb2 != 0 || $nb3 != 0 || $nb4 != 0) {
        if ($nb1 != 0) {
            $req = $req1;
            $statut = 'Boursier Et Logé';
        } elseif ($nb2 != 0) {
            $req = $req2;
            $statut = 'Boursier';
        } elseif ($nb3 != 0) {
            $req = $req3;
            $statut = 'Non Boursier';
        } elseif ($nb4 != 0) {
            $req = $req4;
            $statut = 'Boursier Non Logé';
        }
        $result = $req->fetch();
        ?>
            <div class="row text-center">
            <div class="col-12">
                <h1 class="titre">MODIFIER ETUDIANT</h1>
            </div>
        </div>
        <div id="erreur">
            <p>Vous n'avez pas rempli correctement les champs du formulaire !</p>
        </div>
    <form action="../class/test.php" method="POST">
        <input type="hidden" name="matricule" value="<?php echo $result['matEtudiant'] ?>">
        <input type="hidden" name="statut" value="<?php echo $statut ?>">
        <input type="hidden" name="id" value="<?php echo $result['idEtudiant'] ?>">
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="nom" name="nom" class="form-control champ" value="<?php echo $result['nomEtudiant'] ?>" placeholder="Entrer le Nom">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" id="prenom" name="prenom" class="form-control champ" value="<?php echo $result['prenomEtudiant'] ?>" placeholder="Entrer le Prenom">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $result['mailEtudiant'] ?>" placeholder="Entrer Email">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                </div>
                <input type="number" id="tel" name="tel" min=300000000 value="<?php echo $result['telEtudiant'] ?>" class="form-control champ" placeholder="Entrer le Numéro de Téléphone">
            </div>
            <div class="input-group mb-3 col-12 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" id="dateNaiss" max= <?php echo date('Y-m-d'); ?> name="dateNaiss" class="form-control" value="<?php echo $result['naissEtudiant'] ?>" placeholder="Entrer Date de Naissance">

            </div>
            <span id="age">L'âge doit être compris entre 18 et 30 ans </span>
        </div>
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="form-check">
<input class="form-check-input" type="radio" <?php if ($nb1 != 0 || $nb2 != 0 || $nb4 != 0) {?>checked <?php }?> name="bourse" id="boursier" value="Boursier">
                    <label class="form-check-label" for="boursier">
                        Boursier
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" <?php if ($nb3 != 0) {?>checked <?php }?> name="bourse" id="nonboursier" value="NonBoursier">
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
                            <!-- <option value="0">Choisir une Bourse</option> -->
                            <?php
Database::connect();
        $retour = TypeBourse::selectType();
        while ($data = $retour->fetch()) {
            ?>
                                    <option value="<?php echo $data['idType'] ?>" <?php if (isset($result['idType'])) {if ($data['idType'] == $result['idType']) {echo 'selected';} else {echo '';}}?>><?php echo $data['libelle'] . " - montant : " . $data['montant']; ?></option>
                                    <?php
// echo "<option value=" . $data['idType'];
            // if($data['idType']==$result['idType'])
            //     echo "selected";
            // echo ">" . $data['libelle'] . " - montant : " . $data['montant'] . "</option>";
        }
        ?>
                        </select>
                    </div>
                    <span id="montant">Vous devez Selectionner un type de bourse </span>
                    <div class="input-group mb-3 col-12 col-md-6" id="afficheNonBoursier">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" id="adresse" name="adresse" class="form-control champ" value="<?php if ($nb3 != 0) {
            echo $result['adresseNB'];
        }
        ?>" placeholder="Entrer l'adresse">
                    </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12 col-md-6" id="afficheLoger">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" <?php if ($nb1 != 0) {?>checked <?php }?>  name="loger" value="Loger" id="loger">
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
        $chambres = Database::$base->query('SELECT * FROM chambre ORDER BY idBat ASC');
        $chambresParBat = array();
        while ($chambre = $chambres->fetch()) {
            $chambresParBat[$chambre['idBat']][$chambre['idChambre']] = $chambre['nomChambre'] . " - n° " . $chambre['num'];
        }
        ?>
                         <select class="custom-select" name="batiment" id="batiment">
                         <option value="0">Choisir Un Batiment</option>
                        <?php

        while ($data = $batiments->fetch()) {
            ?>
            <option value="<?php echo $data['idBat'] ?>" <?php if (isset($result['idChambre'])) {if ($data['idBat'] == $result['idChambre']) {echo 'selected';} else {echo '';}}?>><?php echo $data['nomBat'] ?></option>
            <?php
        }
        ?>
        
                    </select>
                    <span id="bat">Vous devez Selectionner un batiment </span>
                </div>
            </div>
            <div class="row" id="afficheChambre">
                <div class="input-group mb-3 col-12 col-md-6" id="AChambre">


                        <?php

                        foreach ($chambresParBat as $idBat => $chambres) {
                        ?>
                        <div class="input-group" id="batiment-<?=$idBat;?>">
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
        <button type="submit" name="ajouter" id="ajouter" class="btn btn-primary">Modifier</button>
        <button type="submit" name="supprimer" id="supprimer" class="btn btn-danger" onclick="confirm('Etes vous sur de vouloir supprimer cet etudiant?')">Supprimer</button>
    </form>
            <?php
            Database::connect();
        if (isset($_POST['supprimer'])) {
            $mat = $_POST['matricule'];
            $sql = "DELETE FROM etudiant WHERE matEtudiant=?";
            $val = array($mat);
            $retour = Database::$base->prepare($sql);
            $retour->execute($val);
        }
        if (isset($_POST['ajouter'])) {
            $id=$_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $tel = $_POST['tel'];
            $datenaiss = $_POST['dateNaiss'];
            $bourse = $_POST['bourse'];
            $matricule = $_POST['matricule'];
            $statut=$_POST['statut'];
            $sql="UPDATE etudiant SET matEtudiant=?, nomEtudiant=?, prenomEtudiant=?, mailEtudiant=?, telEtudiant=?, naissEtudiant=? WHERE isEtudiant=?";
            $val=array($matricule, $nom, $prenom, $mail, $tel, $datenaiss,$i);
            $retour = Database::$base->prepare($sql);
            $retour->execute($val);
            if (isset($_POST['typeBourse'])) {
                $type = $_POST['typeBourse'];
            }

            if (isset($_POST['adresse'])) {
                $adresse = $_POST['adresse'];
            }

            if (isset($_POST['loger'])) {
                $loger = $_POST['loger'];
                if ($loger == "Loger") {
                    if (isset($_POST['chambre'])) {
                        $chambre = $_POST['chambre'];
                        if($statut=="Non Boursier"){
                            //suppression de la table non boursier
                            $sql1 = "DELETE FROM nonBoursier WHERE idEtudiant=?";
                            $val1 = array($id);
                            $retour1 = Database::$base->prepare($sql1);
                            $retour1->execute($val1);
                            //insertion dans la table boursier
                            $sql1 = "INSERT INTO boursier (idEtudiant,idType) VALUES (?,?)";
                            $val1 = array($id,$type);
                            $retour1 = Database::$base->prepare($sql1);
                            $retour1->execute($val1);
                            //insertion dans la table loger
                            $sql1 = "INSERT INTO loger (idEtudiant,idChambre) VALUES (?,?)";
                            $val1 = array($id,$chambre);
                            $retour1 = Database::$base->prepare($sql1);
                            $retour1->execute($val1);
                        }else{
                            if($statut=="Boursier"){
                                //modification dans la table boursier
                                $sql1 = "UPDATE boursier SET idType=? WHERE idEtudiant=?";
                                $val1 = array($id,$type);
                                $retour1 = Database::$base->prepare($sql1);
                                $retour1->execute($val1);
                                //insertion dans la table loger
                                $sql1 = "INSERT INTO loger (idEtudiant,idChambre) VALUES (?,?)";
                                $val1 = array($id,$chambre);
                                $retour1 = Database::$base->prepare($sql1);
                                $retour1->execute($val1);
                            }else{
                                //modification dans la table boursier
                                $sql1 = "UPDATE loger SET idChambre=? WHERE idEtudiant=?";
                                $val1 = array($id,$chambre);
                                $retour1 = Database::$base->prepare($sql1);
                                $retour1->execute($val1);
                            }
                        }
                    }
                }
            }elseif ($bourse == "Boursier") {
                if($statut=="Non Boursier"){
                    //suppression de la table non boursier
                    $sql1 = "DELETE FROM nonBoursier WHERE idEtudiant=?";
                    $val1 = array($id);
                    $retour1 = Database::$base->prepare($sql1);
                    $retour1->execute($val1);
                    //insertion dans la table boursier
                    $sql1 = "INSERT INTO boursier (idEtudiant,idType) VALUES (?,?)";
                    $val1 = array($id,$type);
                    $retour1 = Database::$base->prepare($sql1);
                    $retour1->execute($val1);
                }else{
                    if($statut=="Boursier Et Logé"){
                        //suppression de la table loger
                        $sql1 = "DELETE FROM loger WHERE idEtudiant=?";
                        $val1 = array($id);
                        $retour1 = Database::$base->prepare($sql1);
                        $retour1->execute($val1);
                        //modification dans la table boursier
                        $sql1 = "UPDATE boursier SET idType=? WHERE idEtudiant=?";
                        $val1 = array($id,$type);
                        $retour1 = Database::$base->prepare($sql1);
                        $retour1->execute($val1);
                    }else{
                        //modification dans la table boursier
                        $sql1 = "UPDATE boursier SET idType=? WHERE idEtudiant=?";
                        $val1 = array($id,$type);
                        $retour1 = Database::$base->prepare($sql1);
                        $retour1->execute($val1);
                    }
                }
            } elseif ($bourse == "NonBoursier") {
                if($statut=="Boursier Et Logé"){
                    //suppression de la table boursier
                    $sql1 = "DELETE FROM boursier WHERE idEtudiant=?";
                    $val1 = array($id);
                    $retour1 = Database::$base->prepare($sql1);
                    $retour1->execute($val1);
                    //ajout dans la table nonboursier
                    $sql1 = "INSERT INTO nonBoursier (idEtudiant,adresseNB) VALUES (?,?)";
                    $val1 = array($id,$type);
                    $retour1 = Database::$base->prepare($sql1);
                    $retour1->execute($val1);
                }else{
                    //modification dans la table boursier
                    $sql1 = "UPDATE nonBoursier SET adresseNB=? WHERE idEtudiant=?";
                    $val1 = array($id,$adresse);
                    $retour1 = Database::$base->prepare($sql1);
                    $retour1->execute($val1);
                }
            }
        }
    }
}

?>
            </div>
        <!-- </div> -->
    </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/form.js"></script>
</body>
</html>
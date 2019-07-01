<?php
session_start();
require_once 'Autoloader.class.php';
Autoloader::register();
Database::connect();
if (isset($_POST['supprimer'])){
    $mat=$_POST['matricule'];
    Database::connect();
    $sql="DELETE FROM etudiant WHERE matEtudiant=?";
    $val=array($mat);
    $retour=Database::$base->prepare($sql);
    $retour->execute($val);
    header("location:../pages/modifEtudiant.php");
}
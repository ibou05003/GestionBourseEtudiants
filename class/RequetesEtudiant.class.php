<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesEtudiant
{
    public static function insererEtudiant(Etudiant $etudiant)
    {
        $req = 'INSERT INTO etudiant (matEtudiant,nomEtudiant,prenomEtudiant,mailEtudiant,telEtudiant,naissEtudiant)
        VALUES(?,?,?,?,?,?)';
        $val = array($etudiant->getMatricule(),
            $etudiant->getNom(),
            $etudiant->getPrenom(),
            $etudiant->getMail(),
            $etudiant->getTel(),
            $etudiant->getDateNaiss());
        Database::executeUpdate($req, $val);
    }
    public static function inserer($table, $attribut, $para, $id)
    {
        $req = "INSERT INTO $table (idEtudiant,$attribut) VALUES(?,?)";
        $val = array($id, $para);
        Database::executeUpdate($req, $val);
    }
    public static function trouveId()
    {
        $req = "SELECT * FROM etudiant ORDER BY idEtudiant DESC LIMIT 1";
        $retour = Database::$base->query($req);
        while ($row = $retour->fetch()) {
            $id=$row['idEtudiant'];
            break;
        }
        return $id;
    }
    public static function trouveType($libelle){
        $req = 'SELECT * FROM typeBourse WHERE libelle=?';
        $val=array($libelle);
        $retour = Database::$base->prepare($req);
        $retour->execute($val);
        while ($row = $retour->fetch()) {
            $id=$row['idType'];
            break;
        }
        return $id;
    }
    // public static function trouveChhambre($num){
    //     $req = 'SELECT * FROM typeBourse WHERE libelle=?';
    //     $val=array($libelle);
    //     $retour = Database::$base->prepare($req);
    //     $retour->execute($val);
    //     while ($row = $retour->fetch()) {
    //         $id=$row['idType'];
    //         break;
    //     }
    //     return $id;
    // }
}

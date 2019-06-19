<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesEtudiant
{
    public static function insererEtudiant($matE, $nomE, $prenomE, $mailE, $telE, $datNaissE)
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('INSERT INTO etudiant (matEtudiant,nomEtudiant,prenomEtudiant,mailEtudiant,telEtudiant,naissEtudiant) VALUES(?,?,?,?,?,?)');
            $retour->execute(array($matE, $nomE, $prenomE, $mailE, $telE, $datNaissE));
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
}


<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesBat
{
    public static function insererBat(Batiment $nom)
    {
       // Database::connect();
        try
        {
            $req = 'INSERT INTO chambre (nomBat) VALUES(?)';
            $val = array($nom->getNom());
            Database::executeUpdate($req, $val);
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        //Database::deconnect();
    }
    public static function afficherBats()
    {
        //Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->query('SELECT * FROM batiment');
            $i = 1;
            echo '<h1>LISTE DES BATIMENTS</h1>';
            echo '<table>
                    <thead>';
                        Tableau::th('#');
                        Tableau::th('Nom');
                    echo '</thead>';
            while ($data = $retour->fetch()) {
                echo '<tr>';
                Tableau::td($i);
                Tableau::td($data['nomBat']);
                echo '</tr>';
                $i++;
            }
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
       // Database::deconnect();
    }
    public static function afficherUnBat($id)
    {
       // Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('SELECT nomBat FROM batiment WHERE idBat=?');
            $retour->execute(array($id));
            while ($data = $retour->fetch()) {
                echo $data['nomBat'];
            }

        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        //Database::deconnect();
    }
}

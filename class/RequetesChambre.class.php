<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesChambre
{
    /*public static function insererChambre($nom, $id)
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('INSERT INTO chambre (nomChambre,idBat) VALUES(?,?)');
            $retour->execute(array($nom, $id));
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }*/
    public static function afficherChambres($retour)
    {
        $i = 1;
        echo '<h1>LISTE DES CHAMBRES</h1>';
        echo '<table>
                    <thead>';
        Tableau::th('#');
        Tableau::th('Numero');
        Tableau::th('Nom');
        Tableau::th('Batiment');
        echo '</thead>';
        while ($data = $retour->fetch()) {
            echo '<tr>';
            Tableau::td($i);
            Tableau::td($data['num']);
            Tableau::td($data['nomChambre']);
            Tableau::td($data['bat']);
            echo '</tr>';
            $i++;
        }
        echo '</7table>';
    }
}

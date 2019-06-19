<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesChambre
{
    public static function insererChambre($nom, $id)
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
    }
    public static function afficherChambres()
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->query('SELECT chambre.nomChambre,batiment.nomBat as bat FROM chambre LEFT JOIN batiment ON chambre.idBat=batiment.idBat');
            $i = 1;
            echo '<h1>LISTE DES CHAMBRES</h1>';
            echo '<table>
                    <thead>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Batiment</th>
                    </thead>';
            while ($data = $retour->fetch()) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $data['nomChambre'] . '</td>';
                echo '<td>' . $data['bat'] . '</td></tr>';
                $i++;
            }
            echo '</7table>';
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
}

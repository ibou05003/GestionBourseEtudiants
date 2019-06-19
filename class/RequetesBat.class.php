<?php
require_once 'Autoloader.class.php';
Autoloader::register();
class RequetesBat
{
    public static function insererBat($nomBat)
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('INSERT INTO batiment (nomBat) VALUES(?)');
            $retour->execute(array($nomBat));
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
    public static function afficherBats()
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->query('SELECT * FROM batiment');
            $i = 1;
            echo '<h1>LISTE DES BATIMENTS</h1>';
            echo '<table>
                    <thead>
                        <th>#</th>
                        <th>Nom</th>
                    </thead>';
            while ($data = $retour->fetch()) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $data['nomBat'] . '</td></tr>';
                $i++;
            }
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
    public static function afficherUnBat($id)
    {
        Database::connect();
        try
        {
            Database::$base->exec('SET CHARACTER SET URF8');
            $retour = Database::$base->prepare('SELECT nomBat FROM batiment WHERE idBat=?');
            $retour->execute(array($id));
            while ($data = $retour->fetch()){
                echo $data['nomBat'];
            }
                
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
        Database::deconnect();
    }
}

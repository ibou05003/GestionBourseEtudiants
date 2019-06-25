<?php
class Database
{
    private static $dbhost = "localhost";
    private static $dbname = "gesetudiant";
    private static $dbuser = "root";
    private static $dbpwd = "Moussa030";
    public static $base = null;

    public static function connect()
    {
        try {
            self::$base = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbuser, self::$dbpwd);
        } catch (PDOexception $e) {
            die($e->getMessage());
        }
    }
    public static function deconnect()
    {
        self::$base = null;
    }
    public static function executeSelect($select)
    {
        self::$base->exec('SET CHARACTER SET URF8');
        $retour = self::$base->query($select);
        return $retour;
    }
    public static function executeUpdate($requete, array $attribut)
    {
        self::$base->exec('SET CHARACTER SET URF8');
        $retour = self::$base->prepare($requete);
        $retour->execute($attribut);
    }
    public static function executeUpdate1($requete, array $attribut)
    {
        self::$base->exec('SET CHARACTER SET URF8');
        $retour = self::$base->prepare($requete);
        $retour->execute($attribut);
        
        return $retour;
    }
}
//executeSelect()
//executeUpdate()

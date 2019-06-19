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
}
//executeSelect()
//executeUpdate()
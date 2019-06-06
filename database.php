<?php


class Database
{
    //properties
    private static $user = 'root';
    private static $pass = '';
    private static $db = 'needgrub';
    private static $dsn = 'mysql:host=localhost;dbname=needgrub';
    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                include 'error.php';
                exit();
            }
        } 
        return self::$dbcon;
    }
}
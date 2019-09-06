<?php
namespace App\Helpers;
use PDO;
class Database {
    private static $host;
    private static $username;
    private static $password;
    
    public static function init($host, $username, $password)
    {
        self::$host     = $host;
        self::$username = $username;
        self::$password = $password;
    }

    public static function create($database)
    {
        $dsn = "mysql:host=".self::$host;
        $pdo = new PDO($dsn , self::$username, self::$password);

       
        return  $pdo->query('CREATE DATABASE '.$database);
    }

    public static function createIsWithoutPdoWorked($database) {
        $connetion = mysql_connect(self::$host, self::$username, self::$password);
        $retour = mysql_query('CREATE DATABASE '.$database, $connetion);
        mysql_close($connetion);
    }
}

?>
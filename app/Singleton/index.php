<?php

class Connection
{
    private static $connection = null;
    private static $host = 'db';
    private static $user = 'root';
    private static $password = 'secret';
    private static $dbName = 'testdb';

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (is_null(self::$connection)) {
            self::$connection = new PDO("mysql:host=" . self::$host . ";" . "dbname=" .
                self::$dbName, self::$user, self::$password);
            return self::$connection;
        }
        return self::$connection;
    }
}


$con1 = new PDO("mysql:host=db;dbname=testdb",'root','secret');
var_dump($con1);
$con2 = new PDO("mysql:host=db;dbname=testdb",'root','secret');
var_dump($con2);
$con3 = new PDO("mysql:host=db;dbname=testdb",'root','secret');
var_dump($con3);
$con4 = new PDO("mysql:host=db;dbname=testdb",'root','secret');
var_dump($con4);

$connection1 = Connection::getConnection();
var_dump($connection1);

$connection2 = Connection::getConnection();
var_dump($connection2);
$connection3 = Connection::getConnection();
var_dump($connection3);

<?php

require_once __DIR__.'/../config/database.php';

class db
{
    var $pdo;

    function connect()
    {
        global $db_config;

        $connection_string = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db_config['host'], $db_config['database'], $db_config['charset']);
        $this->pdo = new PDO($connection_string, $db_config['user'], $db_config['password']);
    }

    function query($sql)
    {
        return $this->pdo->query($sql);
    }

    function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
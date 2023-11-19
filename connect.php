<?php


function getConnection()
{
    try {
        $dsn = "mysql:host=localhost;dbname=fiipractic";
        $connection = new PDO($dsn, "root", null);
    }catch (PDOException $exception) {
        echo "CANNOT_CONNECT_TO_DB";
        exit;
    }

    return $connection;
}
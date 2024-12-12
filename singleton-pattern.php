<?php

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;

    private function __construct() {}

    // method getConnection() to get the database connection
    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    // method connect() that simulates connecting to a database and prints a message.
    public function connect(): void
    {
        echo "Connection to database succesfully\n";
    }
}


// Testing the Singleton

$db1 = DatabaseConnection::getInstance();
$db1->connect();

$db2 = DatabaseConnection::getInstance();
$db2->connect();

// Check if both instances are the same
var_dump($db1 === $db2); // Output: bool(true)

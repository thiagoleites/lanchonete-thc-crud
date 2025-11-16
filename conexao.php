<?php

declare(strict_types=1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_lanchonete";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

use Exception;
use mysqli;
use RuntimeException;

class Connection
{
    private const HOST = "localhost";
    private const USER = "root";
    private const PASS = "";
    private const DB = "db_lanchonete";

    private static ?self $instance = null;

    private mysqli $connection;

    private function __construct()
    {
        $this->connection = new mysqli(
            self::HOST,
            self::USER,
            self::PASS,
            self::DB
        );

        if ($this->connection->connect_error) {
            throw new RuntimeException("Erro de conexão: " . $this->connection->connect_error);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function close(): void
    {
        if ($this->connection) {
            $this->connection->close();
        }

        self::$instance = null;
    }

    private function __clone() {}

}

?>



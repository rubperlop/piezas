<?php

namespace FormacionAPP;

use PDO;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Class BaseQuery
 */
class BaseQuery
{
    /**
     * @var PDO Database connector
     */
    public PDO $conn;

    /**
     * @var string The host name
     */
    private string $hostname = "localhost";

    /**
     * @var string The database username
     */
    private string $username = "root";

    /**
     * @var string The database password
     */
    private string $password = "root";

    /**
     * @var string The database name
     */
    private string $database = "af01";

    public function __construct()
    {
        $this->create_connection();
    }

    /**
     * Connect to database
     * @return void
     */
    private function create_connection() :void
    {
        try {
            $this->conn = new PDO("mysql:host={$this->hostname};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
}
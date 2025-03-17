<?php
class Database
{
    private $host = "localhost:3300";
    private $db_name = "test1";
    private $username = "root";
    private $password = "1234";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}

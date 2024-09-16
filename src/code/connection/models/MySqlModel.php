<?php

use Dotenv\Dotenv;

class MysqlConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $charset = 'utf8mb4';
    private $connection;

    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if (empty($host) || empty($username) || empty($password) || empty($database)) {
            $dotenv = Dotenv::create(__DIR__ . '/../../../../');

            $dotenv->load();

            $host = $_ENV['DB_HOST'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $database = $_ENV['DB_DATABASE'];
        }
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    private function connect()
    {
        try {
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database};charset={$this->charset}", $this->username, $this->password, $options);
            //set timezon el salvador
            $this->connection->query("SET time_zone = '-06:00'");
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
            die();
        }
    }

    public function query($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        try {
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            if ($this->connection->inTransaction()) {
                $this->connection->rollBack();
            }

            $errorInfo = $stmt->errorInfo();
            $errorCode = $errorInfo[1];
            $errorMessage = $errorInfo[2];

            http_response_code(500);

            $response = [
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage
                ]
            ];

            echo json_encode($response);
            exit;
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

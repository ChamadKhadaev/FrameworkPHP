<?php
namespace Core;

use PDO;
use PDOException;

class DatabaseConfig
{
    private $host = '127.0.0.1';
    private $db   = 'test';
    private $user = 'root';
    private $pass = '';
    private $port = "3306";
    private $charset = 'utf8mb4';
    private $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

    public function __construct($host, $db, $user, $pass, $port, $charset, $options)
    {
        $this->host = $host;
        $this->db   = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
        $this->charset = $charset;
        $this->options = $options;
    }

   public function connect(): PDO
   {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset;port=$this->port";
        try {
            $pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;

   }

}
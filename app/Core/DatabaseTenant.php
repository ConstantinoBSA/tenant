<?php

namespace App\Core;

require_once __DIR__ . '/../../config/constants.php';

class DatabaseTenant
{
    private static $instance = null;
    private $pdoTenant;

    public function __construct($database, $user, $password)
    {
        $dsn = 'mysql:host='.DB_HOST.';dbname='.$database.';charset=utf8mb4';
        $user = $user;
        $password = $password;

        try {
            $this->pdoTenant = new \PDO($dsn, $user, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (\PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
            exit;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdoTenant;
    }
}

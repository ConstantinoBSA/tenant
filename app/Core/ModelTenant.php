<?php

namespace App\Core;

class ModelTenant
{
    protected $pdo;

    public function __construct()
    {
        $this->pdoTenant = DatabaseTenant::getInstance()->getConnection();
    }
}

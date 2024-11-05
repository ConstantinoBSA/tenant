<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DatabaseTenant;
use App\Models\System\Tenant;
use App\Models\Tenant\Usuario;

class TenantController extends Controller
{
    private $tenantModel;

    public function __construct() {
        $this->tenantModel = new Tenant();
    }

    public function handleRequest($subdomain) {
        // Verificar se o subdomínio corresponde a um tenant válido
        if ($this->tenantModel->getTenantByName($subdomain)) {
            // session_start();

            new DatabaseTenant($this->tenantModel->database_name, $this->tenantModel->database_user, $this->tenantModel->database_password);
            
            $usuarioModel = new Usuario();
            $usuarios = $usuarioModel->read();
            dd($usuarios);

            return $subdomain;
            // Implementar lógica de exibição da área do tenant
        } else {
            return false;
        }
    }
}

<?php

// Configuração inicial

use App\Controllers\SystemController;
use App\Controllers\TenantController;

chdir(dirname(__DIR__)); // Ajusta o diretório de trabalho para o diretório raiz

// Inclusão do autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// Inclua a classe Request
require_once __DIR__ . '/../app/Request.php';
require __DIR__ . '/../app/Routing/Router.php';


// Configurações do Ambiente
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Captura da requisição
$request = Request::capture();

// Roteamento básico
$uri = trim($request->server('REQUEST_URI'), '/');
$method = $request->server('REQUEST_METHOD');

// Capturar o host da solicitação
$host = $_SERVER['HTTP_HOST'];

// Explodir o host para verificar o subdomínio
$parts = explode('.', $host);

// Se houver mais de dois partes, isso indica a presença de um subdomínio
if (count($parts) > 1) {
    $subdomain = $parts[0]; // obter o subdomínio

    // Carregar o controlador do tenant
    $tenantController = new TenantController();
    $tenantId = $tenantController->handleRequest($subdomain);

    echo 'Encontro o tenant: '. $tenantId;
} else {
    // URL principal: carregar o sistema de gerenciamento
    $systemController = new SystemController();
    $systemController->handleRequest();
}

$router = new Router();

require __DIR__ . '/../routes/web.php';

// Captura e despacho da requisição
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->dispatch($requestUri, $requestMethod);

<?php
// Front controller do novo sistema de gerenciamento do salão de beleza

session_start();

require_once 'config.php';

// Autoload simples para classes
spl_autoload_register(function ($class) {
    $paths = ['controllers/', 'models/'];
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Roteamento simples
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Definição das rotas
$routes = [
    'GET' => [
        '/' => ['ClienteController', 'index'],
        '/clientes' => ['ClienteController', 'index'],
        '/clientes/novo' => ['ClienteController', 'create'],
        '/clientes/editar' => ['ClienteController', 'edit'], // espera ?id=
    ],
    'POST' => [
        '/clientes/salvar' => ['ClienteController', 'store'],
        '/clientes/atualizar' => ['ClienteController', 'update'],
        '/clientes/deletar' => ['ClienteController', 'delete'],
    ],
];

// Função para enviar resposta 404
function notFound()
{
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
    exit;
}

// Encontrar a rota
if (isset($routes[$method][$uri])) {
    $controllerName = $routes[$method][$uri][0];
    $action = $routes[$method][$uri][1];
    $controller = new $controllerName();
    $controller->$action();
} else {
    notFound();
}

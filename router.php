<?php
// Arquivo router.php para servidor embutido do PHP
$requested = $_SERVER['REQUEST_URI'];
$path = parse_url($requested, PHP_URL_PATH);
$file = __DIR__ . $path;

if ($path !== '/' && file_exists($file)) {
    return false; // Serve o arquivo estático diretamente
} else {
    include __DIR__ . '/index.php'; // Redireciona para index.php para roteamento
}

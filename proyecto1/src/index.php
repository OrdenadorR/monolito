<?php
$basePath = '/';

// Autoload de Composer (Phroute)
require_once 'vendor/autoload.php';

use Phroute\Phroute\RouteCollector;

// Creación del Router:
$router = new RouteCollector();

//Definición de rutas:
$router->get('/', function () {
    include "views/template/header.php";
    include "views/template/menu.php";
    include "views/template/login.php";
    include "views/template/footer.php";
});

$router->get('/bucle', function () {
    include "views/template/header.php";
    include "views/template/menu.php";
    include "views/bucle.php";
    include "views/template/footer.php";
});

$router->get('/passwordGenerator', function () {
    include "views/passwordGenerator.php";
});

$router->post('/passwordGenerator', function () {
    include "views/passwordGenerator.php";
});

// -------------------------
// Dispatcher
// -------------------------

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

// Obtener la ruta actual y eliminar el subdirectorio si aplica
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '/' && str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
}
if ($path === '') $path = '/';

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $path);
    // Si la función devuelve algo, imprimirlo
    if ($response !== null) {
        echo $response;
    }
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    // 404 simple
    http_response_code(404);
    echo "Página no encontrada";
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    // 405 simple
    http_response_code(405);
    echo "Método HTTP no permitido";
}

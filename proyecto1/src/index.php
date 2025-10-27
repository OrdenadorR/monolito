<?php
$basePath = '/';

// Autoload Composer
require_once 'vendor/autoload.php';
require 'App/Interface/ControllerInterface.php';
require 'App/Controller/UserController.php';

use App\Controller\UserController;
use Phroute\Phroute\RouteCollector;

session_start(); // Inicia la sesión y mantiene PHPSESSID

$router = new RouteCollector();

$router->get('/register-form', [UserController::class, 'showRegister']); // Mostrar formulario de registro
$router->post('/register', function () { // Procesar registro
    $controller = new App\Controller\UserController();
    return $controller->store($_POST);
});

$router->get('/login', [UserController::class, 'showLogin']);
$router->post('/login', [UserController::class, 'login']); // Login de usuario


$router->get('/usercon/{id}', [UserController::class, 'show']); // Mostrar usuario por ID
$router->delete('usercon/{id}', [UserController::class, 'destroy']); // Borrar usuario por ID
$router->get('show', [UserController::class, 'show']); // Mostrar todos los usuarios (ejemplo)

$router->get('/', function () { // Página principal
    include "App/Views/frontend/header.php";
    include "App/Views/frontend/menu.php";
    include "App/Views/frontend/footer.php";
});

//$router->get('/login', function () { // Mostrar formulario de login
//    include "App/Views/frontend/header.php";
//    include "App/Views/frontend/menu.php";
//    include "App/Views/frontend/login.php";
//    include "App/Views/frontend/footer.php";
//});

$router->post('/user/login', [UserController::class, 'verify']); // Verificar login

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData()); // Despachador

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '/' && str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
}
if ($path === '') $path = '/';

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $path);
    if ($response !== null) {
        echo $response;
    }
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    http_response_code(404);
    echo "Página no encontrada";
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    http_response_code(405);
    echo "Método HTTP no permitido";
}

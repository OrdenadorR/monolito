<?php
$basePath = '/';

// Autoload Composer
require_once 'vendor/autoload.php';
require 'app/Interface/ControllerInterface.php';
require 'app/Controller/UserController.php';

use App\Controller\UserController;
use Phroute\Phroute\RouteCollector;

session_start(); // Inicia la sesión

$router = new RouteCollector();

// RUTAS REGISTRO
$router->get('/register-form', [UserController::class, 'showRegister']); // Mostrar formulario
$router->post('/register', function () { // Procesar registro
    $controller = new UserController();
    return $controller->store($_POST);
});

// RUTAS LOGIN
$router->get('/login', [UserController::class, 'showLogin']); // Mostrar formulario
$router->post('/login', function() { // Procesar login
    $controller = new UserController();
    return $controller->verify();
});

// OTRAS RUTAS
$router->get('/usercon/{id}', [UserController::class, 'show']); // Mostrar usuario por ID
$router->delete('/usercon/{id}', [UserController::class, 'destroy']); // Borrar usuario
$router->get('/show', [UserController::class, 'show']); // Mostrar todos los usuarios

// PÁGINA PRINCIPAL
$router->get('/', function () {
    include "app/Views/frontend/header.php";
    include "app/Views/frontend/menu.php";
    include "app/Views/frontend/footer.php";
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

// Obtener path actual
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '/' && str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
}
if ($path === '') $path = '/';

try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $path);

    if ($response !== null) {
        // Si es array, mostramos mensaje legible
        if (is_array($response)) {
            if ($response['success']) {
                echo "<p style='color:green;'>¡Login correcto! Usuario: " . $response['user']['username'] . "</p>";
                echo "<p>UUID: " . $response['user']['uuid'] . "</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $response['message'] . "</p>";
            }
        } else {
            echo $response;
        }
    }

} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    http_response_code(404);
    echo "Página no encontrada";
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    http_response_code(405);
    echo "Método HTTP no permitido";
}
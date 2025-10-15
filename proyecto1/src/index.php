<?php
$basePath = '/';

// Autoload Composer
require_once 'vendor/autoload.php';

use App\Controller\UserController;
use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->get('/usercon', [UserController::class, 'index']);
$router->get('show', [UserController::class, 'show']);

$router->get('/', function () {
    include "views/template/header.php";
    include "views/template/menu.php";
    include "views/template/footer.php";
});

$router->get('/login', function () {
    include "views/template/header.php";
    include "views/template/menu.php";
    include "views/template/login.php";
    include "views/template/footer.php";
});

$router->post('/login', function () {
    $user = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($user && $password) {
        // Ruta al archivo de usuarios
        $loginFile = __DIR__ . '/logins/users.txt';

        // Guardamos en formato "user:password" (ojo: no es seguro guardar en texto plano)
        $line = $user . ':' . password_hash($password, PASSWORD_DEFAULT) . PHP_EOL;

        // Añadimos al archivo
        file_put_contents($loginFile, $line, FILE_APPEND | LOCK_EX);

        echo "Usuario guardado correctamente.";
    } else {
        echo "Faltan datos de usuario o contraseña.";
    }
});



$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

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

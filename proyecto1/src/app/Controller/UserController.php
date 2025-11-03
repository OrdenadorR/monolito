<?php

namespace App\Controller;

use App\Interface\ControllerInterface;
use App\Enum\UserType;
use App\Model\UserModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator;
use App\Views\frontend\login;
use App\views\template\header;

class UserController implements ControllerInterface
{

    function index()
    {
        $usuarios = UserModel::getAllUsers();
        var_dump($usuarios);

    }

    function show($id)
    {
        if (isset($_SESSION['username'])){
            //Muestro la vista con lso datos del usuario.
        }
        else {
            //Muestro una vista de que no se puede acceder a estos datos.
        }
        return "Hola" + $id;
    }

    function store(array $dataToStore)
    {
        $username = $dataToStore['username'] ?? null;
        $email = $dataToStore['email'] ?? null;
        $password = $dataToStore['password'] ?? null;

        if (empty($username) || empty($password)) {
            return 'Faltan datos';
        }

        $loginFile = __DIR__ . '/../../data/users.txt';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $line = $username . ':' . $email . ':' . $hashedPassword . PHP_EOL;

        file_put_contents($loginFile, $line, FILE_APPEND | LOCK_EX);

        // Guardamos datos en sesión (ya iniciada desde index.php)
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        header("Location: /");
        exit;
    }


    function update($id)
    {
        //Lee del fichero input los datos que llegan en la petición PUT
        parse_str(file_get_contents('php://input'), $_POST);
        var_dump($_POST);
    }

    function destroy($id)
    {
        return "Voy a destruir el id $id";
    }

    function create()
    {
        // TODO: Implement create() method.
    }

    function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function verify() {
        // Capturamos los datos enviados por POST
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        echo "<pre>";
        echo "Datos recibidos:\n";
        var_dump(['username' => $username, 'password' => $password]);

        // Aquí simulas la verificación en base de datos
        // Para demo, usamos un usuario fijo
        $usuarios = [
            'admin' => '$2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' // hash de ejemplo
        ];

        $resultado = [
            'success' => false,
            'message' => 'Usuario o contraseña no existe',
            'user' => null
        ];

        if (isset($usuarios[$username])) {
            // Verificamos la contraseña
            if (password_verify($password, $usuarios[$username])) {
                // Login correcto
                $_SESSION['username'] = $username;
                $_SESSION['uuid'] = Uuid::uuid4()->toString();

                $resultado['success'] = true;
                $resultado['message'] = 'Login correcto';
                $resultado['user'] = [
                    'username' => $username,
                    'uuid' => $_SESSION['uuid']
                ];
            }
        }

        // Mostramos en pantalla
        echo "\nResultado de login:\n";
        var_dump($resultado);

        echo "</pre>";

        // También devolvemos el array para usarlo en código
        return $resultado;
    }

    function showLogin()
    {
        include_once "app/Views/frontend/header.php";
        include_once "app/Views/frontend/menu.php";
        include_once "app/Views/frontend/login.php";
        include_once "app/Views/frontend/footer.php";
    }

    function showRegister(){
        include_once "app/Views/frontend/header.php";
        include_once "app/Views/frontend/menu.php";
        include_once "app/Views/frontend/register.php";
        include_once "app/Views/frontend/footer.php";
    }

    function logout() {
        session_destroy();
    }
}
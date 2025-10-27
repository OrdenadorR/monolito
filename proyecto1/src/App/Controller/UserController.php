<?php

namespace App\Controller;

use App\Interface\ControllerInterface;
use App\Class\User;
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
        return "Voy a destruir el director con id $id";
    }

    function create()
    {
        // TODO: Implement create() method.
    }

    function edit($id)
    {
        // TODO: Implement edit() method.
    }

    function verify() {
        $_POST['username'];
        $_POST['password'];

        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        var_dump(password_verify($_POST['password'], $hash));
        # Petición a la base de datos para comprobar si el usuario existe.

        $idUsuario = "5656"; // Número para pruebas
        // si es correcto el login
        $_SESSION['username']=$_POST['username'];
        $_SESSION['uuid']=$idUsuario;
    }

    function showLogin()
    {
        include_once "App/Views/frontend/header.php";
        include_once "App/Views/frontend/menu.php";
        include_once "App/Views/frontend/login.php";
        include_once "App/Views/frontend/footer.php";
    }

    function showRegister(){
        include_once "App/Views/frontend/menu.php";
        include_once "App/Views/frontend/header.php";
        include_once "App/Views/frontend/register.php";
        include_once "App/Views/frontend/footer.php";
    }

    function logout() {
        session_destroy();
    }
}
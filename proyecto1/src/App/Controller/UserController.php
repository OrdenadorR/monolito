<?php

namespace App\Controller;

use App\Interface\ControllerInterface;
use App\Class\User;
use App\Enum\UserType;
use App\Model\UserModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator;

class UserController implements ControllerInterface
{

    function index()
    {
        $usuarios = UserModel::getAllUsers();
        var_dump($usuarios);

    }

    function show($id)
    {
        return "Hola" + $id;
    }

    function store(array $dataToStore)
    {
        if(empty($dataToStore['username']) || $dataToStore['password']){
            return 'Faltan datos';
        }

        return 'Función en UserController accediendo';


    }

    function update($id)
    {
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
}
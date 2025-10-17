<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class UserController implements ControllerInterface
{

    function index()
    {
        return "Hola";
    }

    function show($id)
    {
        //
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
        // TODO: Implement update() method.
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
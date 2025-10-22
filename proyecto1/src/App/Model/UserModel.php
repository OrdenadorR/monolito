<?php

namespace App\Model;

use App\Class\User;
use Ramsey\Uuid\Uuid;

class UserModel
{
    public static function getAllUsers():array {

        $usuario1 = new User(
            Uuid::uuid4(),
            "Pablo",
            "olbap",
            "pablo@gmail.com",
            null

        );
        $usuario2 = new User(
            Uuid::uuid4(),
            "Laura",
            "arual",
            "laura@gmail.com",
            null
        );

        $usuarios=[$usuario1, $usuario2];

        return $usuarios;
    }
}
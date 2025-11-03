<?php

namespace App\Class;

use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Validator as v;



class User implements \JsonSerializable
{
    private UuidInterface $uuid;
    private $nombre;
    private $password;
    private $email;
    private $userType;

    private array $visualizaciones = [];

    public function __construct(UuidInterface $uuid, $nombre, $password, $email, $userType){
        $this->uuid=$uuid;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->email = $email;
        $this->userType = $userType;
    }

    public function getUuid(): UuidInterface{
        return $this->uuid;
}
    public function jsonSerialize(): mixed
    {
        return [
            'uuid' => $this->uuid->toString(),  // Convertimos el UUID a string
            'nombre' => $this->nombre,
            'email' => $this->email,
            'userType' => $this->userType,
            'visualizaciones' => $this->visualizaciones,
        ];
    }

//    public static function validateUserEdit(array $userData):User|array {
//
//        return array;
//    }
}
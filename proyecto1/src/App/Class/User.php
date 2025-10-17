<?php

namespace App\Class;

class User
{
    private $nombre;
    private $password;
    private $email;
    private $userType;

    public function __construct($nombre, $password, $email, $userType){
        $this->nombre = $nombre;
        $this->password = $password;
        $this->email = $email;
        $this->userType = $userType;
    }
}
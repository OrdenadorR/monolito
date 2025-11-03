<?php
namespace App\Model;
use App\Class\User;
use Ramsey\Uuid\Uuid;
use \PDO;

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

    public static function saveUser(User $user):bool{
        try {
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto", "root", "toor");

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $error) {
            echo $error;
            return false;
        }


        $sql = "INSERT INTO user values(:uuide, :username, :password, :email, :edad, :type)";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue('uuid', $user->getUuid());
        $sentenciaPreparada->bindValue('username', $user->getUsername());
        $sentenciaPreparada->bindValue('password', $user->getPassword());
        $sentenciaPreparada->bindValue('email', $user->getEmail());
        $sentenciaPreparada->bindValue('type', $user->getType()->name);

        $sentenciaPreparada->execute();

        if($sentenciaPreparada->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }

    //public static function getUserByUserName()

    //public static function getUserByEmail()
}
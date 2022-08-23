<?php

namespace App\Model;

use Core\Database;
use PDOException;

class RegisterModel
{
    public $username;
    public $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function createUserModel()
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];

            Database::query('INSERT INTO users (username, password) VALUES (:username, :password)',
                [
                    'username' => $username,
                    'password' => $password
                ]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
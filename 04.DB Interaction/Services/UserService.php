<?php
declare(strict_types=1);

namespace Services;


use Adapter\DatabaseInterface;
use Models\User;


class UserService implements UserServiceInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }


    public function register($username, $password): bool
    {
        $stmt = $this->db->prepare(" INSERT INTO users (`user_name`, `user_password`) 
                VALUES (?, ?) 
            ");

        return $stmt->execute(
            [
                $username, 
                $password
            ]
        );
    }

    public function isPasswordMatch($password, $confirm): bool
    {
        return $password == $confirm;
    }

    public function userExists($username): bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `user_name` = ?");

        $stmt->execute(
            [
                $username
            ]
        );

        return (bool)$stmt->fetchRow();  
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `user_name` = ?");

        $stmt->execute(
            [
                $username
            ]
        );

        $user = $stmt->fetchRow();

        if (!$user) {
            throw new \Exception("Username does not exist");
        }

        if ($user['user_password'] != $password) {
            throw new \Exception("Password mismatch");
        }

        return $user['id'];
    }

    public function getInfo($id): User
    {
        $stmt = $this->db->prepare("SELECT id, `user_name` FROM users WHERE id = ?");
        $stmt->execute(
            [$id]
        );

        return $stmt->fetchObject(User::class);
    }

}
<?php


namespace Data\Users;


class User
{
    private $id;

    private $password;

    private $nickname;

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNickname()
    {
        return $this->nickname;
    }
}
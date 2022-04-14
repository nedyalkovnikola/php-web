<?php


namespace Data\Users;


class UserLoginViewData
{
    private $error = null;

    public function __construct($error = null)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
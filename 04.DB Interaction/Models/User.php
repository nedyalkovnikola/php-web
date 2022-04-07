<?php


namespace Models;


class User
{
    private $id;

    private $user_name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->user_name;
    }

    
}
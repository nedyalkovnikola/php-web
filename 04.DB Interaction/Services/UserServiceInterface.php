<?php


namespace Services;


interface UserServiceInterface 
{
    public function register($username, $password): bool;

    public function userExists($username): bool;

    public function isPasswordMatch($password, $confirm): bool;

    public function login($username, $password);
}
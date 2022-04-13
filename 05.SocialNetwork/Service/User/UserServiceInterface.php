<?php


namespace Service\User;

use Data\Users\UserRegisterViewData;

interface UserServiceInterface
{
    public function getRegisterViewData(): UserRegisterViewData;

    public function register(string $firstName,
                             string $lastName,
                             string $nickname,
                             string $email,
                             string $password,
                             string $confirmPassword,
                             string $phone,
                             \DateTime $birthday,
                             int $genderId,
                             int $countryId,
                             int $cityId,
                             string $description = null,
                             string $pictureUrl = null);


    public function login($username, $password): bool;
}


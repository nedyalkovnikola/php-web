<?php


namespace Service\User;

use Data\Users\UserRegisterViewData;
use Data\Users\AllUsersViewData;
use Data\Users\User;

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

    /**
     * @return AllUsersViewData
     */
    public function findAll(): AllUsersViewData;

    public function findByFilter($gender, $country, $city, $minAge, $maxAge): AllUsersViewData;

    public function findOne($id): User;
}


<?php


namespace Data\Users;


use Data\Cities\City;
use Data\Genders\Gender;
use Data\Countries\Country;

class UserRegisterViewData
{
    /**
     * @var Gender[]|\Generator
     */
    private $genders;

    /**
     * @var City[]|\Generator
     */
    private $cities;

    /**
     * @var Country[]|\Generator
     */
    private $countries;

    /**
     * @return Gender[]|\Generator
     */
    public function getGenders()
    {
        return $this->genders;
    }

    /**
     * @param callable $genders
     */
    public function setGenders(callable $genders)
    {
        $this->genders = $genders();
    }

    /**
     * @return City[]|\Generator
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param callable $cities
     */
    public function setCities(callable $cities)
    {
        $this->cities = $cities();
    }

    /**
     * @return Country[]|\Generator
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param callable $countries
     */
    public function setCountries(callable $countries)
    {
        $this->countries = $countries();
    }

}
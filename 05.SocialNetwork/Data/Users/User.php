<?php


namespace Data\Users;

use Data\Message\MessagesViewData;

class User
{
    private $id;

    private $password;

    private $firstName;

    private $lastName;

    private $nickname;

    private $email;

    private $phone;

    private $bornOn;

    private $gender;

    private $country;

    private $city;

    private $picture;

    private $description;

    /**
     * @var MessagesViewData
     */
    private $unreadMessages;

    /**
     * @var MessagesViewData
     */
    private $allMessages;

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getBornOn()
    {
        return $this->bornOn;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getUnreadMessages()
    {
        return $this->unreadMessages;
    }

    public function setUnreadMessages(MessagesViewData $unreadMessages)
    {
        $this->unreadMessages = $unreadMessages;
    }

    public function getAllMessages()
    {
        return $this->allMessages;
    }

    public function setAllMessages(MessagesViewData $allMessages)
    {
        $this->allMessages = $allMessages;
    }
}
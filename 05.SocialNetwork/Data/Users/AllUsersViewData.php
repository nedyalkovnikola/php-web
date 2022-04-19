<?php


namespace Data\Users;


class AllUsersViewData
{
    /**
     * @var \Generator|UserViewData[]
     */
    private $users;

    /**
     * @var UserRegisterViewData
     */
    private $additionalData;

    private $minYears;

    private $maxYears;

    /**
     * @return mixed
     */
    public function getMinYears()
    {
        return $this->minYears;
    }

    /**
     * @param mixed $minYears
     */
    public function setMinYears($minYears)
    {
        $this->minYears = $minYears;
    }

    /**
     * @return mixed
     */
    public function getMaxYears()
    {
        return $this->maxYears;
    }

    /**
     * @param mixed $maxYears
     */
    public function setMaxYears($maxYears)
    {
        $this->maxYears = $maxYears;
    }

    /**
     * @return \Generator|Users[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param callable
     */
    public function setUsers(callable $users)
    {
        $this->users = $users();
    }

    /**
     * @return UserRegisterViewData
     */
    public function getAdditionalData(): UserRegisterViewData
    {
        return $this->additionalData;
    }

    /**
     * @param UserRegisterViewData $additionalData
     */
    public function setAdditionalData(UserRegisterViewData $additionalData)
    {
        $this->additionalData = $additionalData;
    }
}
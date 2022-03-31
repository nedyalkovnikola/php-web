<?php

class UserLifecycle
{
    private $data = [];

    public function __construct()
    {
        require_once 'database.php';
        $this->data = $users;
    }

    /**
     * @param string $username
     * @return string $password
     */
    public function getPassword(string $username): string
    {
        return $this->data[$username]['password'];
    }

    public function getEmail(string $username): string
    {
        return $this->data[$username]['email'];
    }

    public function getBirthday(string $username): string
    {
        return $this->data[$username]['birthday'];
    }

    public function getFullName(string $username): string
    {
        return $this->data[$username]['full_name'];
    }


    /**
     * @param array $data           The posted data when trying to login
     * @param array $userInfo       Referent information with user info e.g. session
     * @return bool
     * @throws Exception
     */
    public function login(array $data, array &$userInfo): bool
    {
        $loginName = $data['username'];
        $loginPass = $data['password'];

        if (array_key_exists($loginName, $this->data)) {
            if ($this->data[$loginName]['password'] == $loginPass) {
                $userInfo['user'] = $loginName;
                return true;
            } else {
                throw new \Exception("Password mismatch");
            }
        } else {
            throw new \Exception("Wrong username");
        }
    }


    /**
     * @param string $username      The old username e.g. $_SESSION['user']
     * @param array $data           The posted new data
     * @param array $userInfo       Referent information with user info e.g. session
     * @return bool                 Whether the saving succeeded
     * @throws Exception
     */
    public function edit(string $username, array $data, array &$userInfo): bool
    {
        $newUser = $data['username'];
        if ($newUser == $username) {
            $this->data[$newUser] = [
                "password" => $data['password'],
                "email" => $data['email'],
                "birthday" => $data['birthday'],
                "full_name" => $this->data[$newUser]['full_name']
            ];
        } else {
            if (array_key_exists($newUser, $this->data)) {
                throw new \Exception("Username is already taken");
            }
            $this->data[$newUser] = [
                "password" => $data['password'],
                "email" => $data['email'],
                "birthday" => $data['birthday'],
                "full_name" => $this->data[$username]['full_name']
            ];

            unset($this->data[$username]);
        }

        $userInfo['user'] = $newUser;
        $usersAsText = var_export($this->data, true);
        $declaration = '<?php' . PHP_EOL . '$users = ' . $usersAsText . ';';
        $result = file_put_contents('database.php', $declaration);

        return $result !== false;
    }

    /**
     * @param string $username
     * @return int
     */
    public function daysUntilBirthday(string $username): int
    {
        $birthDate = $this->getBirthday($username);             // get the birthdate string
        $birthDateObj = new \DateTime($birthDate);              // convert birthdate to DateTime obj
        $interval = $birthDateObj->diff(new \DateTime('now'));  // find difference between birthdate and current date
        $remainingDays = ($interval->format('%a')) % 356;       // calculate the remaining days to Birthday
        return $remainingDays;
    }
}
<?php

class UserLifecycle
{
    private $data = [];

    public function __construct()
    {
        require_once 'db/database.php';
        $this->data = $users;
    }


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

    public function getRole(string $username): string
    {
        return $this->data[$username]['role'];
    }

    public function getUsers(): array
    {
        return $this->data;
    }

    /**
     * @param string $username
     * @return bool
     * @throws Exception
     */
    public function deleteUser(string $username): bool 
    {
        if ($this->data[$username]['role'] == 'admin') {
            throw new \Exception("Administrators can not be deleted!");
        }

        unset($this->data[$username]);

        $usersAsText = var_export($this->data, true);
        $declaration = '<?php' . PHP_EOL . '$users = ' . $usersAsText . ';';
        $result = file_put_contents('db/database.php', $declaration);

        return $result !== false;
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
     * @param string $username      The old username
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
                "password" => $this->testInput($data['password']),
                "email" => $this->testInput($data['email']),
                "birthday" => $this->testInput($data['birthday']),
                "full_name" => $this->data[$newUser]['full_name'],
                "role" => $this->data[$newUser]['role']
            ];
        } else {
            if (array_key_exists($newUser, $this->data)) {
                throw new \Exception("Username is already taken");
            }
            $this->data[$newUser] = [
                "password" => $this->testInput($data['password']),
                "email" => $this->testInput($data['email']),
                "birthday" => $this->testInput($data['birthday']),
                "full_name" => $this->data[$username]['full_name'],
                "role" => $this->data[$username]['role']
            ];

            unset($this->data[$username]);
        }

        $userInfo['user'] = $newUser;

        $usersAsText = var_export($this->data, true);       // convert the array value to a string
        $declaration = '<?php' . PHP_EOL . '$users = ' . $usersAsText . ';';    // concatenate to a string representing variable declaration 
        $result = file_put_contents('db/database.php', $declaration);              // save in database.php as text again and override the old one

        return $result !== false;
    }


    /**
     * @param array $data       The posted user data
     * @return bool             Whether the registration succeeded
     * @throws Exception
     */
    public function register(array $data): bool
    {
        $username = $this->testInput($data['username']);
        $password = $this->testInput($data['password']);

        if ($data['confirm'] != $password) {
            throw new \Exception("Password mismatch");
        }

        $email = $this->testInput($data['email']);
        $birthday = $this->testInput($data['birthday']);
        $full_name = $this->testInput($data['full_name']);
        $role = $data['role'];

        if (array_key_exists($username, $this->data)) {
            throw new \Exception("Username is already taken");
        }

        $this->data[$username] = [
            'password' => $password,
            'email' => $email,
            'birthday' => $birthday,
            'full_name' => $full_name,
            'role' => $role
        ];

        // Persist the new registration into our array database
        $usersAsText = var_export($this->data, true);
        $declaration = '<?php' . PHP_EOL . '$users = ' . $usersAsText . ';';
        $result = file_put_contents('db/database.php', $declaration);

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @param mixed $input
     */
    private function testInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }

    /**
     * @param string $username
     * @return int
     */
    public function daysUntilBirthday(string $username): int
    {
        $birthDate = $this->getBirthday($username);             // get the birthdate string
        $birthDateObj = new \DateTime($birthDate);              // assign new DateTime obj
        $interval = $birthDateObj->diff(new \DateTime('now'));  // find the difference between birthdate and current date
        $remainingDays = ($interval->format('%a')) % 356;       // calculate the remaining days to user's birthday
        
        return $remainingDays;
    }
}
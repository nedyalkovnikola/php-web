<?php


namespace Service\User;


use Adapter\DatabaseInterface;
use Data\Cities\City;
use Data\Countries\Country;
use Data\Genders\Gender;
use Data\Users\AllUsersViewData;
use Data\Users\UserRegisterViewData;
use Data\Users\User;
use Data\Users\UserViewData;
use Service\Encryption\EncryptionServiceInterface;
use Service\Message\MessageService;

class UserService implements UserServiceInterface
{
    const MIN_AGE_ALLOWED = 12;

    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(DatabaseInterface $db,
                                EncryptionServiceInterface $encryptionService)
    {
        $this->db = $db;
        $this->encryptionService = $encryptionService;
    }

    public function getRegisterViewData(): UserRegisterViewData
    {
        $userRegisterViewData = new UserRegisterViewData();

        $stmt = $this->db->prepare("SELECT id, name FROM genders ORDER BY id");
        $stmt->execute();
        $userRegisterViewData->setGenders(
            function() use ($stmt) {
                while ($gender = $stmt->fetchObject(Gender::class)) {
                    yield $gender;
                }
            }
        );
        
        $stmt = $this->db->prepare("SELECT id, name FROM cities ORDER BY id");
        $stmt->execute();
        $userRegisterViewData->setCities(
            function() use ($stmt) {
                while ($city = $stmt->fetchObject(City::class)) {
                    yield $city;
                }
            }
        );
        
        $stmt = $this->db->prepare("SELECT id, name FROM countries ORDER BY id");
        $stmt->execute();
        $userRegisterViewData->setCountries(
            function() use ($stmt) {
                while ($country = $stmt->fetchObject(Country::class)) {
                    yield $country;
                }
            }
        );

        return $userRegisterViewData;
    }

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
                            string $pictureUrl = null)
    {
        if ($password != $confirmPassword) {
            throw new \Exceptions\RegisterException("Password mismatch");
        }

        $passwordHash = $this->encryptionService->encrypt($password);

        $interval = $birthday->diff(new \DateTime('now'));
        if ($interval->y < self::MIN_AGE_ALLOWED) {
            throw new \Exceptions\RegisterException("Underage not allowed");
        }

        $query = "INSERT INTO people (
                    first_name,
                    last_name,
                    nickname,
                    email,
                    phone,
                    password,
                    gender_id,
                    born_on,
                    country_id,
                    city_id,
                    description,
                    picture
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                );";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                $firstName,
                $lastName,
                $nickname,
                $email,
                $phone,
                $passwordHash,
                $genderId,
                $birthday->format('Y-m-d'),
                $countryId,
                $cityId,
                $description,
                $pictureUrl
            ]
        );
    }


    public function login($username, $password): bool
    {
        $query = "SELECT 
                        id, password
                    FROM 
                        people 
                    WHERE 
                        nickname = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                $username
            ]
            );

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);

        if (!$user) {
            return false;
        }

        $passwordHash = $user->getPassword();

        if ($this->encryptionService->isValid($passwordHash, $password)) {
            $_SESSION['user_id'] = $user->getId();
            return true;
        }
        
        return false;
    }

    /**
     * @return AllUsersViewData
     */
    public function findAll(): AllUsersViewData
    {
        return $this->find();
    }

    public function findByFilter($gender, $country, $city, $minAge, $maxAge): AllUsersViewData
    {
        $where = "";
        $params = [];
        $where = " WHERE (YEAR(NOW()) - YEAR(people.born_on)) BETWEEN ? AND ?";
        $params[] = $minAge;
        $params[] = $maxAge;

        if ($gender > 0) {
            $where .= " AND people.gender_id = ?";
            $params[] = $gender;
        }

        if ($country > 0) {
            $where .= " AND people.country_id = ?";
            $params[] = $country;
        }

        if ($city > 0) {
            $where .= " AND people.city_id = ?";
            $params[] = $city;
        }

        return $this->find($where, $params);
    }


    public function findOne($id): User
    {
        $query = "SELECT
                    people.id,
                    people.first_name AS firstName,
                    people.last_name AS lastName,
                    people.nickname,
                    people.email,
                    people.phone,
                    DATE_FORMAT(people.born_on, '%Y-%m-%d') AS bornOn,
                    genders.name AS gender,
                    countries.name AS country,
                    cities.name AS city,
                    people.picture,
                    people.description
                FROM
                    people
                INNER JOIN
                    genders
                ON
                    people.gender_id = genders.id
                INNER JOIN
                    countries
                ON
                    people.country_id = countries.id
                INNER JOIN
                    cities
                ON
                    people.city_id = cities.id
                WHERE
                    people.id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        /** @var User $user */
        $user = $stmt->fetchObject(User::class);
        if (!$user->getPicture()) {
            $user->setPicture(dirname($_SERVER['PHP_SELF']) . '/avatars/no-avatar.jpg');
        }

        $messageService = new MessageService($this->db);
        $user->setUnreadMessages($messageService->getNewMessages($id));
        $user->setAllMessages($messageService->getAllMessages($id));

        return $user;
    }

    private function find ($where = null, $params = [])
    {
        $query = "SELECT
                    people.id,
                    people.first_name AS firstName,
                    people.last_name AS lastName,
                    people.nickname,
                    people.email,
                    people.phone,
                    DATE_FORMAT(people.born_on, '%Y-%m-%d') AS bornOn,
                    genders.name AS gender,
                    countries.name AS country,
                    cities.name AS city,
                    people.picture
                FROM
                    people
                INNER JOIN
                    genders
                ON
                    people.gender_id = genders.id
                INNER JOIN
                    countries
                ON
                    people.country_id = countries.id
                INNER JOIN
                    cities
                ON
                    people.city_id = cities.id";


        if ($where) {
            $query .= $where;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        $yearsStmt = $this->db->prepare("SELECT (YEAR(NOW()) - YEAR(born_on)) AS years
                FROM people
                ORDER BY born_on ASC
                LIMIT 1");

        $yearsStmt->execute();
        $years = $yearsStmt->fetchRow()['years'];

        $allUsers = new AllUsersViewData();
        $allUsers->setMinYears(self::MIN_AGE_ALLOWED);
        $allUsers->setMaxYears($years);
        $allUsers->setAdditionalData($this->getRegisterViewData());

        $lazyLoadedAllUsers = function() use ($stmt) 
        {
            /** @var UserViewData $user  */
            while ($user = $stmt->fetchObject(UserViewData:: class)) {
                if (!$user->getPicture()) {
                    $user->setPicture(dirname($_SERVER['PHP_SELF']) . '/avatars/no-avatar.jpg');
                }
                yield $user;
            }
        };

        $allUsers->setUsers($lazyLoadedAllUsers);

        return $allUsers;
    }
}
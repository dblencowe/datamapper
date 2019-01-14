<?php

namespace Dblencowe\DataMapper\Entity;

class User extends Entity
{
    protected $id;
    protected $username;
    protected $type;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $daytimePhone;
    protected $eveningPhone;
    protected $mobile;
    protected $email;

    protected static $map = [
        'daytimePhone' => 'daytime_phone',
        'eveningPhone' => 'evening_phone',
        'username' => ['username', 'transformUsername'],
    ];

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $type
     * @param $password
     * @param $firstname
     * @param $lastname
     * @param $daytimePhone
     * @param $eveningPhone
     * @param $email
     */
    public function __construct(
        int $id,
        string $username,
        int $type,
        string $password,
        string $firstname,
        string $lastname,
        string $daytimePhone,
        string $eveningPhone,
        string $mobile,
        string $email
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->type = $type;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->daytimePhone = $daytimePhone;
        $this->eveningPhone = $eveningPhone;
        $this->mobile = $mobile;
        $this->email = $email;
    }

    public static function fromRow(array $row): User
    {
        return new self(
            $row['UserPK'],
            $row['UserID'],
            $row['UserType'],
            $row['Password'],
            $row['Forename'],
            $row['Surname'],
            $row['DayPhone'],
            $row['EveningPhone'],
            $row['MobilePhone'],
            $row['Email']
        );
    }

    protected function transformUsername(string $value)
    {
        return strrev($value);
    }
}
<?php

namespace Dblencowe\DataMapper\Test;

use Dblencowe\DataMapper\StorageAdapter;
use Dblencowe\DataMapper\Model\User;
use Dblencowe\DataMapper\Mapper\UserMapper;
use PHPUnit\Framework\TestCase;

class DataMapperTest extends TestCase
{
    public function testCanMapUserFromStorage()
    {
        $storage = new StorageAdapter([
            1 => [
                'UserPK' => 1,
                'UserID' => 'example',
                'UserType' => 2,
                'Password' => '$2y$15$vWa/Wl0s9Uiq.pf4vscBBO6egw9hhsUQf8wZSI.OF83Y6ZkBcGbTG',
                'Forename' => 'Dave',
                'Surname' => 'Blencowe',
                'DayPhone' => '000000000',
                'EveningPhone' => '1111111111',
                'MobilePhone' => '2222222222',
                'Email' => 'example@mailinator.com',
            ]
        ]);
        $mapper = new UserMapper($storage);

        $user = $mapper->findById(1);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWillNotMapInvalidData()
    {
        $storage = new StorageAdapter([]);
        $mapper = new UserMapper($storage);

        $mapper->findById(1);
    }
}
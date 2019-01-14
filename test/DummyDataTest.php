<?php

namespace Dblencowe\DataMapper\Test;

use Dblencowe\DataMapper\Model\User;
use PHPUnit\Framework\TestCase;

class DummyDataTest extends TestCase
{

    private static $row = [
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
    ];

    public function testDataIsConverted()
    {
        $user = User::fromRow(self::$row);

        $result = json_decode($user->toString(), true);

        $this->assertEquals($result['username'], 'elpmaxe');
        $this->assertArrayHasKey('daytime_phone', $result);
        $this->assertArrayHasKey('evening_phone', $result);

        echo $result;
    }
}
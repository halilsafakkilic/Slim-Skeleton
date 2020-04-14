<?php

namespace App\Domain\User\Test;

use App\Domain\User\Model\User;
use App\Infrastructure\Test\TestCase;

class UserModelTest extends TestCase
{
    public function userProvider()
    {
        return [
            ['bill.gates', 'Bill', 'Gates'],
            ['steve.jobs', 'Steve', 'Jobs'],
            ['mark.zuckerberg', 'Mark', 'Zuckerberg'],
            ['evan.spiegel', 'Evan', 'Spiegel'],
            ['jack.dorsey', 'Jack', 'Dorsey'],
        ];
    }

    /**
     * @dataProvider userProvider
     *
     * @param $username
     * @param $firstName
     * @param $lastName
     */
    public function testGetters($username, $firstName, $lastName)
    {
        $user = new User($username, $firstName, $lastName);

        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($firstName, $user->getFirstName());
        $this->assertEquals($lastName, $user->getLastName());
    }
}

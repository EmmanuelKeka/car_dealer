<?php

namespace App\Tests\Unit;
use App\Entity\User;
use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @dataProvider UserNameProvider
     */
    public function testUserName($expectedResult)
    {
        $user = new User();
        $user->setUsername($expectedResult);
        $result = $user->getUsername();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider PasswordProvider
     */
    public function testPassword($expectedResult)
    {
        $user = new User();
        $user->setPassword($expectedResult);
        $result = $user->getPassword();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider RoleProvider
     */
    public function testRole($expectedResult)
    {
        $user = new User();
        $user->setRole($expectedResult);
        $result = $user->getRole();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider TransactionProvider
     */
    public function testAddTransaction($expectedResult)
    {
        $user = new User();
        $user->addTransaction($expectedResult);
        $result = $user->getTransactions()[0];
        $this->assertEquals($expectedResult, $result);
    }

    public function testRemoveTransaction()
    {
        $tran = new Transaction();
        $tran->setCardName("emmanuel");
        $user = new User();
        $user->addTransaction($tran);
        $user->removeTransaction($tran);
        $expectedResult = null;
        $result = $user->getTransactions()[0];
        $this->assertEquals($expectedResult, $result);
    }

    public function UserNameProvider()
    {
        return [
            ["Emmanuel"],
            ["Jevic"],
            ["mika"],
        ];
    }
    public function PasswordProvider()
    {
        return [
            ["password"],
            ["key"],
            ["open"],
        ];
    }
    public function RoleProvider()
    {
        return [
            ["ROLE_USER"],
            ["ROLE_ADMIM"],
            ["ROLE_HR"],
        ];
    }
    public function TransactionProvider()
    {
        $tran = new Transaction();
        $tran1 = new Transaction();
        $tran2 = new Transaction();
        $tran->setCardName("emmanuel");
        $tran1->setCardName("emmanuel");
        $tran2->setCardName("emmanuel");
        return [
            [$tran],
            [$tran1],
            [$tran2],
        ];
    }
}
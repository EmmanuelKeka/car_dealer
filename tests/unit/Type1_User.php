<?php

namespace App\Tests\unit;

use App\Entity\Transaction;
use App\Entity\User;
use Monolog\Test\TestCase;

class Type1_User extends TestCase
{
    public function testTYPE_1_01_NotNullAfterConstruction()
    {
        // Arrange
        $user = new User();
        $this->assertNotNull($user);
    }
    public function testTYPE_1_02_GetAndSetUserName()
    {
        // Arrange
        $user = new User();
        $user->setUsername("emmanuel");
        $expectedResult = "emmanuel";
        $result = $user->getUsername();
        $this->assertSame($expectedResult, $result);
    }
    public function testTYPE_1_02_SetAndGetPassword()
    {
        // Arrange
        $user = new User();
        $user->setPassword("emma");
        $expectedResult = "emma";
        $result = $user->getPassword();
        $this->assertSame($expectedResult, $result);
    }
    public function testTYPE_1_02_SetAndGetRole()
    {
        // Arrange
        $user = new User();
        $user->setRole("Admin");
        $expectedResult = "Admin";
        $result = $user->getRole();
        $this->assertSame($expectedResult, $result);
    }
    public function testTYPE_1_02_AddTransactionAndGetTransaction()
    {
        // Arrange
        $user = new User();
        $trans = new Transaction();
        $trans->setUser($user);
        $user->addTransaction($trans);
        $expectedResult = $trans;
        $result = $user->getTransactions()[0];
        $this->assertSame($expectedResult, $result);
    }
    public function testTYPE_1_02_RemoveTransaction()
    {
        // Arrange
        $user = new User();
        $trans = new Transaction();
        $trans->setUser($user);
        $user->addTransaction($trans);
        $user->removeTransaction($trans);
        $expectedResult = null;
        $result = $user->getTransactions()[0];
        $this->assertSame($expectedResult, $result);
    }


}
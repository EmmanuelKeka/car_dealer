<?php

namespace Unit;

use App\Entity\Car;
use App\Entity\Transaction;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TransctionTest extends TestCase
{
    /**
     * @dataProvider CarProvider
     */
    public function testCar($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setCar($expectedResult);
        $result = $transaction->getCar();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider CardNameProvider
     */
    public function testCardName($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setCardName($expectedResult);
        $result = $transaction->getCardName();
        $this->assertEquals($expectedResult, $result);
    }
    /**
     * @dataProvider CardNumberProvider
     */
    public function testCardNumber($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setCardNumber($expectedResult);
        $result = $transaction->getCardNumber();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider CardCvvProvider
     */
    public function testCardCvv($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setCardCvv($expectedResult);
        $result = $transaction->getCardCvv();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider BuyerProvider
     */
    public function testBuyer($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setBuyer($expectedResult);
        $result = $transaction->getBuyer();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider DateProvider
     */
    public function testDate($expectedResult)
    {
        $transaction = new Transaction();
        $transaction->setDate($expectedResult);
        $result = $transaction->getDate();
        $this->assertEquals($expectedResult, $result);
    }

    public function CarProvider()
    {
        $car = new Car();
        $car1 = new Car();
        $car2 =  new Car();
        $car->getMake("audi");
        $car1->getMake("BMW");
        $car2->getMake("Porsh");
        return [
            [$car],
            [$car1],
            [$car2],
        ];
    }
    public function CardNameProvider()
    {
        return [
            ["Emmanuel"],
            ["Jevic"],
            ["mika"],
        ];
    }
    public function CardNumberProvider()
    {
        return [
            ["2343434343434"],
            ["2343243434343"],
            ["4324545445444"],
        ];
    }
    public function CardCvvProvider()
    {
        return [
            ["234"],
            ["774"],
            ["432"],
        ];
    }

    public function BuyerProvider()
    {
        $user = new User();
        $user1 = new User();
        $user2 = new User();
        $user->setUsername("emma");
        $user1->setUsername("linlin");
        $user2->setUsername("luffy");

        return [
            [$user],
            [$user1],
            [$user2],
        ];
    }
    public function DateProvider()
    {
        return [
            [new \DateTime('2013-04-15')],
            [new \DateTime('2013-04-12')],
            [new \DateTime('2013-10-20')],
        ];
    }
}
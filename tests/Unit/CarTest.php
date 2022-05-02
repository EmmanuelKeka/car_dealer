<?php

namespace App\Tests\Unit;

use App\Entity\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    /**
     * @dataProvider CarMakeProvider
     */
    public function testCarMake($expectedResult)
    {
        $car = new Car();
        $car->setMake($expectedResult);
        $result = $car->getMake();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider CarModelProvider
     */
    public function testCarModel($expectedResult)
    {
        $car = new Car();
        $car->setModel($expectedResult);
        $result = $car->getModel();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider ImageProvider
     */
    public function testImage($expectedResult)
    {
        $car = new Car();
        $car->setImage($expectedResult);
        $result = $car->getImage();
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider PriceProvider
     */
    public function testPrice($expectedResult)
    {
        $car = new Car();
        $car->setPrice($expectedResult);
        $result = $car->getPrice();
        $this->assertEquals($expectedResult, $result);
    }

    public function CarMakeProvider()
    {
        return [
            ["AUDI"],
            ["BMW"],
            ["JAGUAR"],
        ];
    }

    public function CarModelProvider()
    {
        return [
            ["A1"],
            ["Series3"],
            ["CLS"],
        ];
    }

    public function ImageProvider()
    {
        return [
            ["A1.pg"],
            ["Series3.pg"],
            ["CLS.pg"],
        ];
    }
    public function PriceProvider()
    {
        return [
            [199923.23],
            [123232.23],
            [32343232.34],
        ];
    }
}
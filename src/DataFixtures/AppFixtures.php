<?php

namespace App\DataFixtures;

use App\Factory\TransactionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\CarFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $matt = UserFactory::createOne([
            'username' => 'customer',
            'password' => 'customer',
            'role' => 'ROLE_CUSTOMER'
        ]);

        $johon = UserFactory::createOne([
            'username' => 'admin',
            'password' => 'admin',
            'role' => 'ROLE_ADMIN'
        ]);
        $linda = UserFactory::createOne([
            'username' => 'hr',
            'password' => 'hr',
            'role' => 'ROLE_HR'
        ]);
        $emmanuel = UserFactory::createOne([
            'username' => 'manager',
            'password' => 'manager',
            'role' => 'ROLE_MANAGER'
        ]);

        $a1 = CarFactory::createOne([
            'image' => 'assets/image/audiA1.jpeg',
            'model' => 'A1',
            'make' => 'Audi',
            'price' => '13447.67'
        ]);

        $a6 = CarFactory::createOne([
            'image' => 'assets/image/audiA6.jpg',
            'model' => 'A6',
            'make' => 'Audi',
            'price' => '34647.50'
        ]);

        $s2 = CarFactory::createOne([
            'image' => 'assets/image/bmw2.jpg',
            'model' => 'Series2',
            'make' => 'BMW',
            'price' => '15847.56'
        ]);

        $cls = CarFactory::createOne([
            'image' => 'assets/image/cls.jpg',
            'model' => 'CLS',
            'make' => 'Mercedes Benz',
            'price' => '66057.90'
        ]);

        $focus = CarFactory::createOne([
            'image' => 'assets/image/ford_focus.jpg',
            'model' => 'Focus',
            'make' => 'Ford',
            'price' => '10447.70'
        ]);

        $urus = CarFactory::createOne([
            'image' => 'assets/image/lamborghini-urus.jpg',
            'model' => 'Urus',
            'make' => 'Lamborghini',
            'price' => '120877.84'
        ]);

        $p911 = CarFactory::createOne([
            'image' => 'assets/image/porsh-911.jpg',
            'model' => 'Porsh',
            'make' => '911',
            'price' => '237877.34'
        ]);

        TransactionFactory::createOne([
            'cardName' => 'matt smith',
            'cardNumber' => "7656786545675434567543",
            'CardCvv' => '678',
            'buyer' => $matt,
            'car' => $a1,
            'date' => new \DateTime('2013-01-15')
        ]);
        TransactionFactory::createOne([
            'cardName' => 'johon',
            'cardNumber' => "7656786545675434567543",
            'CardCvv' => 'CardCvv',
            'buyer' => $johon,
            'car' => $a6,
            'date' => new \DateTime('2013-02-15')
        ]);
        TransactionFactory::createOne([
            'cardName' => 'johon',
            'cardNumber' => "7656786545675434567543",
            'CardCvv' => 'CardCvv',
            'buyer' => $johon,
            'car' => $a6,
            'date' => new \DateTime('2013-04-15')
        ]);
        TransactionFactory::createOne([
            'cardName' => 'johon',
            'cardNumber' => "7656786545675434567543",
            'CardCvv' => 'CardCvv',
            'buyer' => $johon,
            'car' => $a6,
            'date' => new \DateTime('2013-04-15')
        ]);


    }
}

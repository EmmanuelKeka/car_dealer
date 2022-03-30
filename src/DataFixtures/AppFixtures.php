<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\MakeFactory;
use App\Factory\CarFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'username' => 'matt',
            'password' => 'smith',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'john',
            'password' => 'doe',
            'role' => 'ROLE_ADMIN'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/audiA1.jpeg',
            'model' => 'A1',
            'make' => 'Audi'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/audiA6.jpg',
            'model' => 'A6',
            'make' => 'Audi'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/bmw2.jpg',
            'model' => 'Series2',
            'make' => 'BMW'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/cls.jpg',
            'model' => 'CLS',
            'make' => 'Mercedes Benz'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/ford_focus.jpg',
            'model' => 'Focus',
            'make' => 'Ford'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/lamborghini-urus.jpg',
            'model' => 'Urus',
            'make' => 'Lamborghini'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/mercedes.jpg',
            'model' => 'Benz',
            'make' => 'Mercedes'
        ]);

        CarFactory::createOne([
            'image' => 'assets/image/porsh-911.jpg',
            'model' => 'Porsh',
            'make' => '911'
        ]);

    }
}

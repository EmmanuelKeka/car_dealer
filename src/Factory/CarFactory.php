<?php

namespace App\Factory;

use App\Entity\Car;
use App\Repository\CarRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Car>
 *
 * @method static Car|Proxy createOne(array $attributes = [])
 * @method static Car[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Car|Proxy find(object|array|mixed $criteria)
 * @method static Car|Proxy findOrCreate(array $attributes)
 * @method static Car|Proxy first(string $sortedField = 'id')
 * @method static Car|Proxy last(string $sortedField = 'id')
 * @method static Car|Proxy random(array $attributes = [])
 * @method static Car|Proxy randomOrCreate(array $attributes = [])
 * @method static Car[]|Proxy[] all()
 * @method static Car[]|Proxy[] findBy(array $attributes)
 * @method static Car[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Car[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CarRepository|RepositoryProxy repository()
 * @method Car|Proxy create(array|callable $attributes = [])
 */
final class CarFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'make' => self::faker()->text(),
            'model' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Car $car): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Car::class;
    }
}

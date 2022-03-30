<?php

namespace App\Factory;

use App\Entity\Transaction;
use App\Repository\TransactionRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Transaction>
 *
 * @method static Transaction|Proxy createOne(array $attributes = [])
 * @method static Transaction[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Transaction|Proxy find(object|array|mixed $criteria)
 * @method static Transaction|Proxy findOrCreate(array $attributes)
 * @method static Transaction|Proxy first(string $sortedField = 'id')
 * @method static Transaction|Proxy last(string $sortedField = 'id')
 * @method static Transaction|Proxy random(array $attributes = [])
 * @method static Transaction|Proxy randomOrCreate(array $attributes = [])
 * @method static Transaction[]|Proxy[] all()
 * @method static Transaction[]|Proxy[] findBy(array $attributes)
 * @method static Transaction[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Transaction[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TransactionRepository|RepositoryProxy repository()
 * @method Transaction|Proxy create(array|callable $attributes = [])
 */
final class TransactionFactory extends ModelFactory
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
            'cardNumber' => self::faker()->text(),
            'cardName' => self::faker()->text(),
            'CardCvv' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Transaction $transaction): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Transaction::class;
    }
}

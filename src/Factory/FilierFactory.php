<?php

namespace App\Factory;

use App\Entity\Filier;
use App\Repository\FilierRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Filier>
 *
 * @method        Filier|Proxy create(array|callable $attributes = [])
 * @method static Filier|Proxy createOne(array $attributes = [])
 * @method static Filier|Proxy find(object|array|mixed $criteria)
 * @method static Filier|Proxy findOrCreate(array $attributes)
 * @method static Filier|Proxy first(string $sortedField = 'id')
 * @method static Filier|Proxy last(string $sortedField = 'id')
 * @method static Filier|Proxy random(array $attributes = [])
 * @method static Filier|Proxy randomOrCreate(array $attributes = [])
 * @method static FilierRepository|RepositoryProxy repository()
 * @method static Filier[]|Proxy[] all()
 * @method static Filier[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Filier[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Filier[]|Proxy[] findBy(array $attributes)
 * @method static Filier[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Filier[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FilierFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nom' => self::faker()->realtext(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Filier $filier): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Filier::class;
    }
}

<?php
namespace CarloNicora\Minimalism\Services\OAuth\Factories;

use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderInterface;
use CarloNicora\Minimalism\Services\Cacher\Factories\CacheBuilderFactory;

class CacheFactory extends CacheBuilderFactory
{
    /**
     * @param string $token
     * @return CacheBuilderInterface
     */
    public static function token(
        string $token
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'token',
            identifier: $token
        );
    }

    /**
     * @param string $token
     * @return CacheBuilderInterface
     */
    public static function app(
        string $token
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'app',
            identifier: $token
        );
    }

    /**
     * @param string $clientId
     * @return CacheBuilderInterface
     */
    public static function appClientId(
        string $clientId
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'appClientId',
            identifier: $clientId
        );
    }
}
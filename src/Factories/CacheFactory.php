<?php
namespace CarloNicora\Minimalism\Services\OAuth\Factories;

use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderInterface;
use CarloNicora\Minimalism\Services\Cacher\Factories\CacheBuilderFactory;

class CacheFactory extends CacheBuilderFactory
{
    /**
     * @param int $token
     * @return CacheBuilderInterface
     */
    public static function token(
        int $token
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'token',
            identifier: $token
        );
    }

    /**
     * @param int $token
     * @return CacheBuilderInterface
     */
    public static function app(
        int $token
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'app',
            identifier: $token
        );
    }

    /**
     * @param int $clientId
     * @return CacheBuilderInterface
     */
    public static function appClientId(
        int $clientId
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'appClientId',
            identifier: $clientId
        );
    }
}
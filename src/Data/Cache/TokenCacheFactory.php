<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Cache;

use CarloNicora\Minimalism\Interfaces\Cache\Abstracts\AbstractCacheBuilderFactory;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderInterface;

class TokenCacheFactory extends AbstractCacheBuilderFactory
{
    /**
     * @param string $token
     * @return CacheBuilderInterface
     */
    public static function token(
        string $token,
    ): CacheBuilderInterface
    {
        return self::create(
            cacheName: 'token',
            identifier: $token,
        );
    }

}
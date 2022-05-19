<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases;

enum AppReliability: int
{
    case Distrusted = 0;
    case Trusted = 1;
}
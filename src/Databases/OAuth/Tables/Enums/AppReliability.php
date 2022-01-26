<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\Enums;

enum AppReliability: int
{
    case Distrusted = 0;
    case Trusted = 1;
}
<?php

namespace CarloNicora\Minimalism\Services\OAuth\Enums;

enum AppReliability: int
{
    case Distrusted = 0;
    case Trusted = 1;
}
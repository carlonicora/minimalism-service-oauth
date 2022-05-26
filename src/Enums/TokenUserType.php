<?php

namespace CarloNicora\Minimalism\Services\OAuth\Enums;

enum TokenUserType: int
{
    case Visitor = 0;
    case Registered = 1;
}
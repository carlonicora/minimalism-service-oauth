<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Enums;

enum TokenUserType: int
{
    case Visitor = 0;
    case Registered = 1;
}
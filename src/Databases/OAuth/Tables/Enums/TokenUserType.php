<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\Enums;

enum TokenUserType: int
{
    case Visitor = 0;
    case Registered = 1;
}
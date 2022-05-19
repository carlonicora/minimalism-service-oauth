<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases;

enum TokenUserType: int
{
    case Visitor = 0;
    case Registered = 1;
}
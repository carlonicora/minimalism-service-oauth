<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases;

enum AppStatus: int
{
    case Inactive = 0;
    case Active = 1;
}
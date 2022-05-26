<?php

namespace CarloNicora\Minimalism\Services\OAuth\Enums;

enum GrantType: string
{
    case AuthorizationCode = 'authorization_code';
    case Password = 'password';
    case ClientCredentials = 'client_credentials';
    case RefreshToken = 'refresh_token';
}
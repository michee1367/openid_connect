<?php

/*
 * 
 */

namespace Mink67\OpenidConnect\Contracts\User;

use League\OAuth2\Client\Token\AccessToken;

interface OAuthUserProvider
{


    /**
     * Return the OAuthUser
     * @return OAuthUser
     * 
     */
    public function getOAuthUser(
        AccessToken $accessToken, 
        array $roles,
        string $id,
        string $username,
        string $clientId,
        string $realmsUrl,
        string $scope
    ) : OAuthUser;
}

<?php

/**
 * 
 */

namespace Mink67\OpenidConnect\User;

use League\OAuth2\Client\Token\AccessToken;
use Mink67\OpenidConnect\Contracts\User\OAuthUser as IUserOAuth;

class OAuthUser implements IUserOAuth
{
    /**
     * @var AccessToken
     */
    private $accessToken;
    private $roles;
    private $id;
    private $username;
    private $clientId;
    private $realmsUrl;
    private $scope;

    public function __construct(
        AccessToken $accessToken, 
        array $roles,
        string $id,
        string $username,
        string $clientId,
        string $realmsUrl,//scope
        string $scope,//scope
    )
    {
        $this->accessToken = $accessToken;
        $this->roles = $roles;
        $this->id = $id;
        $this->username = $username;
        $this->clientId = $clientId;
        $this->realmsUrl = $realmsUrl;
        $this->scope = $scope;
    }



    public function getRoles(): array {
        return $this->roles;
    }
    /**
     * Get the value of id
     */ 
    public function getId(): string {
        return $this->id;
    }


    /**
     * Get the value of username
     */ 
    public function getNormalUsername(): string {
        return $this->username;
    }
    /**
     * Get the value of accesss_token
     */ 
    public function getAccessToken(): AccessToken {
        return $this->accessToken;
    }


    /**
     * Get the value of clientId
     */ 
    public function getClientId(): string {
        return $this->clientId;
    }


    /**
     * Get the value of realmsUrl
     */ 
    public function getRealmsUrl(): string {
        return $this->realmsUrl;
    }


    /**
     * Get the value of scope
     */ 
    public function getScope(): string {
        return $this->scope;
    }

}

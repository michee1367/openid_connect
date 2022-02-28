<?php

/**
 * 
 */

namespace Mink67\OpenidConnect\Contracts\User;

use League\OAuth2\Client\Token\AccessToken;

interface OAuthUser
{


    public function getRoles(): array;
    /**
     * Get the value of id
     */ 
    public function getId(): string;


    /**
     * Get the value of username
     */ 
    public function getNormalUsername(): string;
    /**
     * Get the value of accesss_token
     */ 
    public function getAccessToken(): AccessToken;


    /**
     * Get the value of clientId
     */ 
    public function getClientId(): string;


    /**
     * Get the value of realmsUrl
     */ 
    public function getRealmsUrl(): string;


    /**
     * Get the value of scope
     */ 
    public function getScope(): string;

}

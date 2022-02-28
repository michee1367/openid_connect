<?php

namespace Mink67\OpenidConnect;

use League\OAuth2\Client\Token\AccessToken;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Mink67\OpenidConnect\Contracts\User\OAuthUser;
use Mink67\OpenidConnect\Contracts\User\OAuthUserProvider;
use Mink67\Security\Converters\Exceptions\InvalidDataException;
//use Mink67\Security\User\OAuthUser;
use Rakit\Validation\Validator;

class AccessTokenToUser {

    /**
     * @var OAuthUserProvider
     */
    private $oAuthUserProvider;

    /**
     * 
     */
    public function __construct(OAuthUserProvider $oAuthUserProvider) {
        $this->oAuthUserProvider = $oAuthUserProvider;
        
    }

    /**
     * @return
     * @param AccessToken $accessToken
     */
    public function convert(AccessToken $accessToken, string $jwks): ?OAuthUser
    {
        $strToken = $accessToken->getToken();
        $jwks = $this->getConcreteJwks($jwks);

        try {

            $data = JWT::decode($strToken, JWK::parseKeySet($jwks), array_keys(JWT::$supported_algs));
            $arrData = json_decode(json_encode($data), true);
            $this->validate($arrData);

            return $this->oAuthUserProvider->getOAuthUser(
                $accessToken,
                $arrData["realm_access"]["roles"],
                $arrData["sub"],
                $arrData["preferred_username"],
                $arrData["azp"],
                $arrData["iss"],
                $arrData["scope"],
            );            
        }
        catch (\Throwable $th) {
            //dd($th);
            return null;
        }
        
    }

    private function getConcreteJwks(string $jwks): array
    {
        $arrJwks = json_decode($jwks, true);

        return $arrJwks;
    }

    private function validate(array $data)
    {
        $validator = new Validator;

        $validation = $validator->make($data, [
            'iss'                  => 'required|url',// realms url
            'azp'                  => 'required',// client id
            'sub'                 => 'required',// id user
            'realm_access'                 => 'required',// roles wrapper 
            'realm_access.roles'                 => 'required|array',// roles container 
            'preferred_username'              => 'required',
            'scope'      => 'required',// scope
        ]);

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();

            throw new InvalidDataException($errors->toArray());            

        } else {
            return true;
        }
        
    }
}
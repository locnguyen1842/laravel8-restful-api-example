<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Nyholm\Psr7\ServerRequest;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Lcobucci\JWT\Parser as JwtParser;

class AccessTokenPasswordFactory extends BaseApiController
{
    /**
     * The client repository instance.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    protected $clients;
    
    /**
     * The authorization server instance.
     *
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    protected $server;
    
    /**
     * The JWT token parser instance.
     *
     * @var \Lcobucci\JWT\Parser
     */
    protected $jwt;

    /**
     * The token repository instance.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokens;

    public function __construct(ClientRepository $clients,
                                AuthorizationServer $server,
                                JwtParser $jwt,
                                TokenRepository $tokens)
    {
        $this->server = $server;
        $this->jwt = $jwt;
        $this->tokens = $tokens;
        $this->clients = $clients;
    }
    
    public function make($username, $password, $client,  array $scopes = ['*'])
    {
        $response = $this->dispatchRequestToAuthorizationServer(
            $this->createRequestToken($username, $password, $client, $scopes)
        );

        return $response;
    }

    protected function createRequestToken($username, $password, $client, array $scopes = ['*'])
    {
        $secret = Passport::$hashesClientSecrets ? $this->clients->getPersonalAccessClientSecret() : $client->secret;

        return (new ServerRequest('POST', 'not-important'))->withParsedBody([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $secret,
            'username' => $username,
            'password' => $password,
            'scope' => $scopes,
        ]);
    }
    
    /**
     * Dispatch the given request to the authorization server.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return array
     */
    protected function dispatchRequestToAuthorizationServer(ServerRequestInterface $request)
    {
        return json_decode($this->server->respondToAccessTokenRequest(
            $request, new Response()
        )->getBody()->__toString(), true);
    }

    
    /**
     * Get the access token instance for the parsed response.
     *
     * @param  array  $response
     * @return \Laravel\Passport\Token
     */
    protected function findAccessToken(array $response)
    {
        return $this->tokens->find(
            $this->jwt->parse($response['access_token'])->getClaim('jti')
        );
    }
}

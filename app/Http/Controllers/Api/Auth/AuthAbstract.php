<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Nyholm\Psr7\ServerRequest;
use \Laravel\Passport\Client;
use GuzzleHttp\Client as Http;

abstract class AuthAbstract extends BaseApiController
{
    /**
     * @var Application
     */
    private $app;

    /**
     * The client repository instance.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    protected $clients;
    
    /**
     * @var string
     */
    protected $guardName = 'api';

    /**
     * @var string
     */
    protected $usernameField = 'email';
    
    /**
     * @var string
     */
    protected $passwordField = 'password';
    
    /**
     * @var string
     */
    public $username;
    
    /**
     * @var string
     */
    public $password;
    
    /**
     * @var Client|null
     */
    public $client;

    /**
     * @var string
     */
    private $provider = 'users';

    public function __construct(Application $app, ClientRepository $clients)
    {
        $this->app = $app;

        $this->clients = $clients;

        $this->makeClientFromGuard();

        $this->makeModel();
    }
    
    /**
     * Log in the user
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    protected function login(Request $request)
    {
        $this->loginValidate($request);

        $user = $this->findUser($this->username);

        if(!Hash::check($this->password, $user->password)){
            return $this->responseInvalidCredentials();
        }

        return response([
            'access_token' => $user->createToken('access_token')->accessToken
        ]);
    }

    protected function requestToken($username, $password, $client, array $scopes = [])
    {
        $secret = Passport::$hashesClientSecrets ? $this->clients->getPersonalAccessClientSecret() : $client->secret;

        return (new ServerRequest('POST', route('passport.token')))->withParsedBody([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $secret,
            'username' => $username,
            'password' => $password,
            'scope' => '*',
        ]);
    }
    
    /**
     * Logout user (Revoke the token)
     */
    protected function logout()
    {
        try {
            authenticated_user($this->guardName)->token()->revoke();
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return response([
            'message' => 'Logged out'
        ]);
    }


    protected function loginValidate(Request $request)
    {
        $credentials = $request->validate([
            $this->usernameField => 'required',
            $this->passwordField => 'required'
        ]);

        $this->username = $credentials[$this->usernameField];
        $this->password = $credentials[$this->passwordField];
    }

    /**
     * Define User
     *
     * @param string $username
     * @return Model
     */
    private function findUser($username)
    {
        return $this->model->where($this->usernameField, $username)->first() ?? $this->responseInvalidCredentials();
    }

    /**
     * Make a client instance
     *
     * @param  int  $id
     */
    private function makeClientFromGuard()
    {
        if($this->guardName) {
            $this->provider = config("auth.guards.$this->guardName.provider");
        }

        $this->client = Client::where('provider', $this->provider)->firstOrFail();
    }
    
    
    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return void
     */
    private function makeModel()
    {
        $model = $this->app->make(config("auth.providers.$this->provider.model"));

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    public function responseInvalidCredentials()
    {
        return response([
            'message' => 'Invalid credentials.',
        ], 400);
    }
}

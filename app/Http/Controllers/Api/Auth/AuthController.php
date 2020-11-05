<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Laravel\Passport\Client;
use Illuminate\Container\Container;

class AuthController extends BaseApiController
{
    /**
     * @var Application
     */
    private $app;
    
    /**
     * @var \Laravel\Passport\Client|null
     */
    protected $client;
    
    /**
     * @var \Illuminate\Foundation\Auth\User|null
     */
    protected $model;
    
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
    protected $tokenName = 'access_token';

    /**
     * @var string
     */
    private $provider = 'users';

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->makeClientFromGuard();

        $this->makeModel();
    }
    
    /**
     * Log in the user
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    protected function login(Request $request)
    {
        $credentials = $this->loginValidate($request);

        $username = $credentials[$this->usernameField];

        $password = $credentials[$this->passwordField];

        $user = $this->findUser($username);

        if(!$user || !Hash::check($password, $user->password)){
            return $this->responseInvalidCredentials();
        }

        $token = $this->createToken($username, $password, $this->client, ['*']);

        return response($token);
    }

    /**
     * Log out the user (Revoke the token)
     * 
     * @param \Illuminate\Http\Request $request
     */
    protected function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response([
            'message' => 'Logged out'
        ]);
    }

    /**
     * Create a new password grant type access token for the user.
     *
     * @param  string  $username
     * @param  string  $password
     * @param  \Laravel\Passport\Client  $client
     * @param  array  $scopes
     * @return array
     */
    public function createToken($username, $password, $client, $scopes = ['*'])
    {
        return Container::getInstance()->make(AccessTokenPasswordFactory::class)->make(
            $username, $password, $client, $scopes
        );
    }

    /**
     * Validate login form
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function loginValidate(Request $request)
    {
        return $request->validate([
            $this->usernameField => 'required',
            $this->passwordField => 'required'
        ]);
    }

    /**
     * Define User
     *
     * @param string $username
     * @return \Illuminate\Foundation\Auth\User
     */
    protected function findUser($username)
    {
        return $this->model->where($this->usernameField, $username)->first();
    }

    /**
     * Make a passport client instance
     * 
     */
    private function makeClientFromGuard()
    {
        if($this->guardName) {
            $this->provider = config("auth.guards.$this->guardName.provider");
        }

        $this->client = Client::where('provider', $this->provider)->firstOrFail();
    }
    
    
    /**
     * Make a model instance
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

    /**
     * Response invalid credentials message
     *
     * @return \Illuminate\Http\Response
     */
    public function responseInvalidCredentials()
    {
        return response([
            'message' => 'Invalid credentials.',
        ], 400);
    }
}

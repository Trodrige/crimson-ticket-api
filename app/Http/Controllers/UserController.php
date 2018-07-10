<?php

namespace App\Http\Controllers;


use App\User;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a new token.
     *
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User   $user
     * @return mixed
     */
    public function login(User $user)
    {
        $this->validate($this->request, [
            'username'     => 'required',
            'password'  => 'required'
        ]);

        // Find the user by username
        $user = User::where('username', $this->request->input('username'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
            // below response for now.
            return response()->json([
                'error' => 'Username does not exist.'
            ], 400);
        }

        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Username or password is wrong.'
        ], 400);
    }

    /**
     * Register a user and return the token if the provided credentials are correct, and user is created.
     *
     * @param  \App\User   $user
     * @return mixed
     */
    public function register(Request $request)
    {
        $this->validate($this->request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        // Find the user by username
        $user = User::where('username', $this->request->input('username'))->first();
        if ($user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
            // below response for now.
            return response()->json([
                'error' => 'Username already exists.'
            ], 400);
        } else {
            $newUser = User::create([
                'firstname' => $this->request->input('firstname'),
                'lastname' => $this->request->input('lastname'),
                'username' => $this->request->input('username'),
                'password' => $this->request->input('password'),
                'role' => $this->request->input('role')
            ]);

            if($newUser) {
                return response()->json([
                    'success' => 'New user created.',
                    'token' => $this->jwt($newUser)
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Error occured creating new user.'
                ], 400);
            }
        }

        /* Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        } */

        // Bad Request response
        return response()->json([
            'error' => 'Username or password is wrong.'
        ], 400);
    }

}

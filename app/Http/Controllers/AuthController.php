<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user and assign a role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // return response([
        //     'message' => 'Registration is disabled.',
        // ], 201);

        // Validate incoming request
        $fields = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string|in:admin,client,staff', // Ensure a valid role
        ]);

        if ($fields->fails()) {
            return response([
                'message' => 'Validation error',
                'errors' => $fields->errors(),
            ], 422);
            
        }

        // Create new user
        $user = User::create([
            'name' => $fields->validated()['name'],
            'email' => $fields->validated()['email'],
            'password' => Hash::make($fields->validated()['password']),
            'role' => $fields->validated()['role'],  // Store role in database
        ]);

        // Create API token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        // Return user data along with generated token
        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Log in an existing user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate incoming request
        $fields = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($fields->fails()) {
            throw new ValidationException($fields);
        }

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        
        // Verify password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials.',
            ], 401);
        }
        
        // Generate and return token
        $token = $user->createToken('authToken')->plainTextToken;


        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Log out the user and revoke all tokens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $user = Auth::user();
        
        if ($user) {   // Check if the user is authenticated
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return response([
                'message' => 'Successfully logged out.',
            ]);
        }else{
            return response([
                'message' => 'User not authenticated.',
            ]);
        }
    }
}

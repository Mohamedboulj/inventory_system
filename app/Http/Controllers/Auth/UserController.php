<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create($request->getData());
        return Response(['User created successfully',SymfonyResponse::HTTP_CREATED]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $success =  $user->createToken('MyApp')->plainTextToken;
            return Response(['token' => $success],SymfonyResponse::HTTP_CREATED);
        }
        if (isset($request->validator) && $request->validator->fails())
        {
            return Response($request->validator->messages(),SymfonyResponse::HTTP_BAD_REQUEST);
        }

        return Response(['message' => 'email or password wrong'],SymfonyResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Retrieve current use details.
     */
    public function userDetails()
    {
        if (Auth::check())
        {
            $user = Auth::user();
            return Response(['data' => $user],SymfonyResponse::HTTP_OK);
        }

        return Response(['data' => 'Unauthorized'],SymfonyResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * logout user.
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout successfully.'],SymfonyResponse::HTTP_OK);
    }

}

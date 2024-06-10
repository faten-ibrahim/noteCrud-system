<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;


class AuthController extends Controller
{

    /**
     * userRepository
     *
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        config()->set('auth.defaults.guard', 'api');
        $this->userRepository = $userRepository;
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request) {

        $user = $this->userRepository->create(
            array_merge($request->only('name','email'),
            ['password'=>Hash::make($request['password'])]));

        return response()->json($user, Response::HTTP_CREATED);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! $token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'Bearer token' => $token,
            'Status' => Response::HTTP_OK
            ])->setStatusCode(Response::HTTP_OK);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

}
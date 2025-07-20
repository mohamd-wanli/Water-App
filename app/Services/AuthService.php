<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Exceptions\AuthException;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function register(array $dto)
    {

        $user = UserDTO::from($dto);
        $exists = $this->repository->findUserByEmail($user->email);
        if ($exists) {
            throw AuthException::emailExists();
        }
        $data = $user->CreateToArray();
        $data = User::create($data);
        return $data;
    }

    public function login(array $credentials)
    {

        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            if (!$user || $user->is_banned) {
                Auth::guard('api')->logout();
                throw AuthException::accountNotActive();
            }
            return $user;
        }

        if (Auth::guard('distributor_api')->attempt($credentials)) {
            $distributor = Auth::guard('distributor_api')->user();
            if (!$distributor || (property_exists($distributor, 'is_banned') && $distributor->is_banned)) {
                Auth::guard('distributor_api')->logout(); // Log out if banned
                throw AuthException::accountNotActive();
            }
            return $distributor;
        }

        throw AuthException::invalidCredentials();
    }






}

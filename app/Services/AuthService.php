<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Exceptions\AuthException;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(private UserRepositoryInterface $repository){
    }
    public function register(array $dto){

        $user=UserDTO::from($dto);
        $exists=$this->repository->findUserByEmail($user->email);
        if($exists){
           throw AuthException::emailExists();
        }
        $data=$user->CreateToArray();
        $data=User::create($data);
        return $data;
    }
      public function login(array $credentials){

      if(! auth()->attempt($credentials)){
        throw AuthException::invalidCredentials();
      }
      $user=auth()->user();
      if(! $user ||  $user->is_banned){
          throw AuthException::accountNotActive();
      }
       return $user;
 }






}

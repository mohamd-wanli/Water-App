<?php

namespace App\Http\Controllers;

use App\ApiHelper\ApiCode;
use App\ApiHelper\ApiResponse;
use App\DTOs\UserDTO;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(private AuthService $authservice){

    }
    public function register(AuthRequest $request){
      $user=$this->authservice->register($request->validated());
      $token=JWTAuth::fromUser($user);
       $data=AuthResource::make($user)->toArray($request);
       $result=array_merge($data,['token'=>$token]);
        return ApiResponse::success($result,'success',ApiCode::OK);
    }
    public function login(LoginRequest $request){
        $user = $this->authservice->login($request->validated());
        $token= JWTAuth::fromUser($user);
        $data=AuthResource::make($user)->toArray($request);
        $result=array_merge($data,['token'=>$token]);
       return ApiResponse::success($result,'success',ApiCode::OK);
    }
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return ApiResponse::success(null, 'success',ApiCode::OK);
    }
}

<?php

namespace App\Exceptions;


use App\ApiHelper\ApiResponse;
use Exception;
class AuthException extends Exception
{
    public static function emailExists(): self
    {
        return new self('The email address is already registered', 400);
    }
    public static function usernotExists() : self {
        return new self('the user not found',400);
    }

    public static function invalidCredentials(): self
    {
        return new self('The provided credentials are invalid.', 401);
    }
    public static function accountNotActive() : self{
        return new self('this account is banned',401);
    }
    public static function accountNotApproved() : self{
        return new self('this account is not active',401);
    }
    public function render($request){
        return ApiResponse::error($this->getMessage(), $this->getCode());
    }

}

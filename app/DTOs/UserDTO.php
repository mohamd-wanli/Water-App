<?php

namespace App\DTOs;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserDTO extends Data
{
public function __construct(
    public ?string $name =null,
    public ?string $email=null,
    public ?string $phone=null,
    public ?string $password=null,


){
}
public function CreateToArray() :array {
    return [
        'name'=>$this->name,
        'email'=>$this->email,
        'phone'=>$this->phone,
        'password'=>Hash::make($this->password),

    ];
}
}

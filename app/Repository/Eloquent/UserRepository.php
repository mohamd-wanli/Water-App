<?php

namespace App\Repository\Eloquent;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Models\User as UserModel;
use App\Repository\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    protected $model;
    public function __construct(UserModel $model){
        $this->model=$model;
    }

    public function findUserByEmail(string $email): ?UserModel
    {
        return $this->model->where('email',$email)->first();
    }

    public function findById(int $id): ?UserModel
    {
        return $this->model->find($id);
    }

    public function update(UserModel $user, array $data): UserModel
    {
        $user->update($data);
        return $user;
    }

    public function delete(UserModel $user): bool
    {
        return $user->delete();
    }
}

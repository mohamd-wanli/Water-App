<?php

namespace App\Repository\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findUserByEmail(string $email): ?User ;
    public function findById(int $id): ?User;
    public function update(User $user,array $data): ?User;
    public function delete(User $user): bool;

}

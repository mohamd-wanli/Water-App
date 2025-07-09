<?php

namespace App\Repository\Interfaces;

interface AdminRepositoryInterface
{

    public function approve(int $id);
    public function reject(int $id);
    public function findById(int $id);
    public function getPending();

}

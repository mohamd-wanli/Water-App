<?php

namespace App\Repository\Interfaces;

interface DistributorRepositoryInterface
{
    public function create(array $data);
    public function update(int $id,array $data);
    public function delete(int $id);
    public function find($id);

}

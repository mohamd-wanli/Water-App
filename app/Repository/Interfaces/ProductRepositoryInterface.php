<?php

namespace App\Repository\Interfaces;

interface ProductRepositoryInterface
{

    public function create(array $data);
    public function findById(int $id);

    public function update(int $id,array $data);
    public function delete(int $id);
    public function getProducts();
    public function getActiveProductsWithFilters(array $filters);
}

<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Types\DistributerRequest;
use App\Types\UserTypes;

class ProductRepository implements ProductRepositoryInterface
{

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findById(int $id)
    {
        $product=Product::findOrFail($id);
        return $product;
    }

    public function update(int $id, array $data)
    {
        $product=$this->findById($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product=$this->findById($id);
        $product->delete();
        return $product;

    }
    public function getProducts()
    {
        return Product::where('distributor_id',auth()->id())->get();
    }
    public function getActiveProductsWithFilters(array $filters)
    {


        return Product::query()
            ->whereHas('distributor', function($query) {
                $query->where('status', DistributerRequest::APPROVED);
            })
            ->when(isset($filters['category']), function($query) use ($filters) {
                $query->where('category', $filters['category']);
            })
            ->when(isset($filters['location']), function($query) use ($filters) {
                $query->whereHas('distributor', function($q) use ($filters) {
                    $q->where('location', 'like', '%'.$filters['location'].'%');
                });
            })
            ->when(isset($filters['distributor_id']), function($query) use ($filters) {
                $query->where('distributor_id', $filters['distributor_id']);
            })
            ->with('distributor')
            ->get();

    }
}

<?php

namespace App\Http\Controllers;

use App\ApiHelper\ApiCode;
use App\ApiHelper\ApiResponse;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(public ProductService $productService){}

    public function create(ProductRequest $request){
        $product=$this->productService->create($request->validated());
        return ApiResponse::success($product,'success',ApiCode::OK);
    }

    public function update(int $id,ProductRequest $request){
        $product=$this->productService->update($id,$request->validated());
        return ApiResponse::success($product,'success',ApiCode::OK);
    }

    public function delete(int $id){
        $product=$this->productService->delete($id);
        $product->delete();
        return ApiResponse::success(null,'success',ApiCode::OK);

    }
    public function getProduct(){
        $products=$this->productService->getProduct();
        // Transform products to include full image URLs
        $products->transform(function ($product) {
            $product->image_url = Storage::url($product->image);
            return $product;
        });
        return ApiResponse::success($products,'success',ApiCode::OK);
    }

    public function index(ProductFilterRequest $request)
    {
        $products = $this->productService->getActiveProducts($request->validated());
        return ApiResponse::success($products,'success',ApiCode::OK);
    }

}

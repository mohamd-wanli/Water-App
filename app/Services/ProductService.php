<?php

namespace App\Services;

use App\ApiHelper\ApiCode;
use App\ApiHelper\ApiResponse;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Traits\Image;
use Illuminate\Support\Facades\Storage;


class ProductService
{
    use Image;
 public function __construct(private ProductRepositoryInterface $productRepository){

 }
 public function create(array $data){
//     $imagePath = $this->uploadImage($data['image']);
//     unset($data['image']);
     $imagePath=$this->processUpload($data);

     $product=$this->productRepository->create(['distributor_id'=>auth()->id(),
         'image' => $imagePath,
         ... $data]);
     return $product;
 }

 public function update(int $id,array $data){
     $product=$this->productRepository->findById($id);
//     if (isset($data['image'])) {
//         // Delete old image
//         Storage::delete($product->image);
//         // Upload new image
//         $imagePath = $this->uploadImage($data['image']);
//         $data['image'] = $imagePath;
//     }
     $updateImage=$this->imageUpdate($data,$product->image);
     $product->update([
         'image' => $updateImage,
         ...$data
     ]);
     return $product;
 }

 public function delete(int $id){
     $product=$this->productRepository->findById($id);
     $this->deleteImage($product->image);
     $product->delete();
     return $product;

 }
//    private function deleteProductImage($imagePath)
//    {
//        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
//            Storage::disk('public')->delete($imagePath);
//        }
//    }
//    private function uploadImage($imageFile): string
//    {
//        return $imageFile->store('products', 'public');
//    }
 public function getProduct(){
     $product=$this->productRepository->getProducts();
     return $product;
 }


    public function getActiveProducts(array $filters)
    {
        return $this->productRepository->getActiveProductsWithFilters($filters);
    }

}

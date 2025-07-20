<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Image
{
    public function uploadImage($imageFile){
        return $imageFile->store('products','public ');
 }
  public function deleteImage(string $imagePath){
      if($imagePath && Storage::disk('public')->exists($imagePath)){
          Storage::disk('public')->delete($imagePath);
      }
  }
  public function processUpload(array $data){
        if(!isset($data['image'])){
            return null;
        }
        $image=$this->uploadImage($data['image']);
        unset($data['image']);
        return $image;
  }
  public function imageUpdate(array $data,string $currentImage){
        if(!isset($data['image'])){
            return $currentImage;
        }
        $this->deleteImage($currentImage);
        return $this->processUpload($data);

  }

}

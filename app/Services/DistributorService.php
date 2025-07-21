<?php

namespace App\Services;

use App\DTOs\DistributorDTO;
use App\Exceptions\AuthException;
use App\Models\Distributor;
use App\Repository\Interfaces\DistributorRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class DistributorService
{
  public function __construct(private DistributorRepositoryInterface $distributorRepository){}

    public function create(array $data){

        $exists=$this->distributorRepository->findDistributorByEmail($data['email']);
        if($exists){
            throw AuthException::emailExists();
        }
        $imagePath = $this->uploadImage($data['commercial_license']);
        unset($data['commercial_license']);
        $result=Distributor::create(['commercial_license'=>$imagePath,

         ...$data]);
        return $result;
    }
    public function update(int $id,array $data){
        $distributor=$this->distributorRepository->find($id);
        if (isset($data['commercial_license'])) {
            // Delete old image
            Storage::delete($distributor->commercial_license);
            // Upload new image
            $imagePath = $this->uploadImage($data['commercial_license']);
            $data['commercial_license'] = $imagePath;
        }
        $distributor->update([
            'commercial_license'=>$imagePath,
            ...$data
        ]);

      return $distributor;
    }
    public function delete(int $id){
      $distributor=$this->distributorRepository->find($id);
        $this->deleteImage($distributor->commercial_license);
      if(!$distributor){
          throw AuthException::usernotExists();
      }
      $distributor->delete();
      return $distributor;

    }
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
    private function uploadImage($imageFile): string
    {
        if (!$imageFile instanceof \Illuminate\Http\UploadedFile) {
            throw new \InvalidArgumentException("Expected an uploaded file.");
        }

        return $imageFile->store('distributors', 'public');
    }
}

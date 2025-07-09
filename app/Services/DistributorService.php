<?php

namespace App\Services;

use App\Exceptions\AuthException;
use App\Models\Distributor;
use App\Repository\Interfaces\DistributorRepositoryInterface;

class DistributorService
{
  public function __construct(private DistributorRepositoryInterface $distributorRepository){}

    public function create(array $data){
       $distributor=$this->distributorRepository->create([
           'user_id'=>auth()->id(),
          ... $data
       ]);
       return $distributor;
    }
    public function update(int $id,array $data){
      $distributor=$this->distributorRepository->update($id,$data);
      return $distributor;
    }
    public function delete(int $id){
      $distributor=$this->distributorRepository->delete($id);
      if(!$distributor){
          throw AuthException::usernotExists();
      }
      return $distributor;

    }
}

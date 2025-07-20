<?php

namespace App\Services;

use App\DTOs\DistributorDTO;
use App\Exceptions\AuthException;
use App\Models\Distributor;
use App\Repository\Interfaces\DistributorRepositoryInterface;

class DistributorService
{
  public function __construct(private DistributorRepositoryInterface $distributorRepository){}

    public function create(array $dto){
        $user=DistributorDTO::from($dto);
        $exists=$this->distributorRepository->findDistributorByEmail($user->email);
        if($exists){
            throw AuthException::emailExists();
        }
        $data=$user->CreateToArray();
        $data=Distributor::create($data);
        return $data;
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

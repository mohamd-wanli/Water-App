<?php

namespace App\Services;

use App\Repository\Interfaces\AdminRepositoryInterface;

class AdminService
{

    public function __construct(private AdminRepositoryInterface $adminRepository){
    }
    public function approve(int $id){
     $status=$this->adminRepository->approve($id);
     return $status;
    }
    public function reject(int $id){
        $status=$this->adminRepository->reject($id);
        return $status;
    }
    public function getPending(){
        $status=$this->adminRepository->getPending();
        return $status;
    }
}

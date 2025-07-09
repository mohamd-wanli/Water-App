<?php

namespace App\Repository\Eloquent;

use App\Models\Distributor;
use App\Repository\Interfaces\AdminRepositoryInterface;
use App\Types\DistributerRequest;

class AdminRepository implements AdminRepositoryInterface
{

    public $model;
    public function __construct(Distributor $model){
        $this->model=$model;
    }

    public function approve(int $id)
    {
     $status=$this->findById($id);
      return $status->forceFill([
         'status'=>DistributerRequest::APPROVED,
     ])->save();

    }

    public function reject($id)
    {
        $status=$this->findById($id);
        return $status->forceFill([
            'status'=>DistributerRequest::REJECTED,
        ])->save();
    }

    public function findById(int $id)
    {
        $distributor=Distributor::findorFail($id);
        return $distributor;
    }

    public function getPending()
    {
        return Distributor::where('status','pending')->get();
    }
}

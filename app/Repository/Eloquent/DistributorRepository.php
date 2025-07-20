<?php

namespace App\Repository\Eloquent;

use App\Models\Distributor;
use App\Repository\Interfaces\DistributorRepositoryInterface;

class DistributorRepository implements DistributorRepositoryInterface
{
    public $model;
    public function __construct(Distributor $model){
       $this->model=$model;
    }

    public function create(array $data)
    {
       return Distributor::create($data);
    }

    public function update(int $id, array $data)
    {
        $distributor=$this->model->find($id);
        $distributor->update($data);
        return $distributor;
    }

    public function delete(int $id)
    {
        $distributor=$this->model->find($id);
       $distributor->delete();
       return $distributor;
    }
    public function find($id)
    {
        return Distributor::findorFail($id);
    }

public function findDistributorByEmail(string $email)
{
    return $this->model->where('email',$email)->first();
}}

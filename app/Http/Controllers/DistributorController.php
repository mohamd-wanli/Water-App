<?php

namespace App\Http\Controllers;

use App\ApiHelper\ApiCode;
use App\ApiHelper\ApiResponse;
use App\Http\Requests\DistributorRequest;
use App\Http\Resources\DistributorResource;
use App\Models\Distributor;
use App\Services\DistributorService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DistributorController extends Controller
{
   public function __construct(protected DistributorService $service){

   }

 public function register(DistributorRequest $request){
       $distributor=$this->service->create($request->validated());
     $token = JWTAuth::fromUser($distributor);
       $result=array_merge(['user:'=>DistributorResource::make($distributor)->toArray($request),'token :'=>$token]);
       return ApiResponse::success($result,'success',ApiCode::OK);

 }
 public function update(int $id,DistributorRequest $request){
  $distributor=$this->service->update($id,$request->validated());
     $result=DistributorResource::make($distributor)->toArray($request);
     return ApiResponse::success($result,'success',ApiCode::OK);
 }

 public function delete(int $id){
       $distributor=$this->service->delete($id);
       return  ApiResponse::success(null,'success',ApiCode::OK);
 }

}

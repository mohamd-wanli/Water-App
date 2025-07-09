<?php

namespace App\Http\Controllers;

use App\ApiHelper\ApiCode;
use App\ApiHelper\ApiResponse;
use App\Services\AdminService;

class AdminController extends Controller
{


    public function __construct(private AdminService $adminService){

    }
    public function approve(int $id){
        $status=$this->adminService->approve($id);
        return ApiResponse::success(null,'success',ApiCode::OK);
    }
    public function reject(int $id){
        $status=$this->adminService->reject($id);
        return ApiResponse::success(null,'success',ApiCode::OK);
    }

    public function getPending(){
        $status=$this->adminService->getPending();
        return ApiResponse::success($status,'success',ApiCode::OK);
    }






}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{

    protected $fillable = [
    'user_id',
    'commercial_license',
    'status',
    'company_name',
    'location',
];
    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

}

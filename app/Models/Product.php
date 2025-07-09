<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'distributor_id',
        'name',
        'description',
        'price',
        'category',
        'image'
    ];
    public function distributor(){
        return $this->BelongsTo(Distributor::class);
    }
}

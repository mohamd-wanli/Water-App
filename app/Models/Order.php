<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'consumer_id',
        'distributor_id',
        'status',
        'deliver_cost',

    ];
    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function distributor(){
        return $this->BelongsTo(Distributor::class);
    }
}

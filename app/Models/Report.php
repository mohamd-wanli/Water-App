<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'distributor_id',
        'product_id',

    ];
    public function user(){
        return $this->BelongsTo(User::class);
    }
}

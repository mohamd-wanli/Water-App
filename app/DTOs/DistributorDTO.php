<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class DistributorDTO extends Data
{
 public function __construct(
     public ?int $user_id=null,
     public ?string $commercial_license=null,
     public ?string $company_name=null,
     public ?string $location=null,
 ){

 }
}

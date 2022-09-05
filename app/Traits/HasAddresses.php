<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\morphOne;
use App\Models\Address;

trait HasAddresses
{
    public function address() : morphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
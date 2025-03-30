<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'restaurant_owner_id');
    }
}

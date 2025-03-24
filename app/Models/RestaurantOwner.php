<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RestaurantOwner extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];
    protected $hidden = ['password'];
}

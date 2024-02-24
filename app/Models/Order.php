<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    function types()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function deliveryAddress()
    {
        return $this->belongsTo(deliveryAddress::class, 'delivery_addresses_id');
    }
}

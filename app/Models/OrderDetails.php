<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    function types()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

}

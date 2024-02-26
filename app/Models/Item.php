<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function types()
    {
        return $this->belongsToMany(Type::class, 'menus', 'item_id', 'type_id');
    }
   
    // function items()
    // {
    //     return $this->belongsTo(Item::class, 'item_id');
    // }
}

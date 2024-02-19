<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $guarded = [];

    function categorys()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'menus', 'type_id', 'item_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'type_id', 'id');
    }
}

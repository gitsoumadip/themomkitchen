<?php

namespace App\Services\Item;

use App\Contracts\Items\ItemContracts;
use App\Models\Category;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class ItemService implements ItemContracts
{
    public function getAll()
    {
        $data = Item::with('types')->where('is_active', 1)->get();
        return $data;
    }
    public function createItem($data)
    {
        $isCreateCategory = Item::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
        return $isCreateCategory;
    }

    public function updateCategory($data)
    {
        $id = uuidtoid($data['uuid'], 'categories');
        $isUpdateCategory = Category::where('id', $id)->first();
        $isUpdateCategory->name = $data['name'];
        $isUpdateCategory->description = $data['description'];
        $isUpdateCategory->save();
        return $isUpdateCategory;
    }

    public function findZoneById($uuid)
    {
        $id = uuidtoid($uuid, 'categories');
        return Category::find($id);
    }
}

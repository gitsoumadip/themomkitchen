<?php

namespace App\Services\Location;

use App\Contracts\Location\LocationContracts;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class LocationService implements LocationContracts
{
    public function getAll()
    {
        $data = Category::where('is_active', 1)->get();
        return $data;
    }
    public function createType($data)
    {
        // dd($data);
        $isCreateCategory = Type::create([
            'categorie_id' => $data['category_id'],
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

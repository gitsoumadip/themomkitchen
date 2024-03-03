<?php

namespace App\Services\Type;

use App\Contracts\Type\TypeContracts;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class TypeService implements TypeContracts
{
    public function getAll()
    {
        $data = Type::with('categorys')->where('is_active', 1)->get();
        // $data->first()->items;
        // dd($data->toArray());
        return $data;
    }
    public function fetchgetAll()
    {
        $data = Type::with('categorys')->get();
        // $data->first()->items;
        // dd($data->toArray());
        return $data;
    }

    public function findById($id)
    {
        // $id = uuidtoid($uuid, 'categories');
        return Type::find($id);
    }

    // public function getAdditionalType()
    // {
    //     $data = Type::with('categorys')->where('is_active', 1)->where('slug','additional')->first();
    //     // $data->first()->items;
    //     // dd($data->toArray());
    //     return $data;
    // }
    public function createType($data)
    {
        // dd($data);
        $imgName = fileUpload($data['img']);
        $isCreateCategory = Type::create([
            'categorie_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'img' => $imgName
        ]);
        return $isCreateCategory;
    }

    public function updateType($data)
    {
        // dd($data);
        // $id = uuidtoid($data['uuid'], 'categories'); 
        $imgName = fileUpload($data['img']);
        $isUpdateCategory = Type::where('id', $data['uuid'])->first();
        $isUpdateCategory->categorie_id = $data['category_id'];
        $isUpdateCategory->name = $data['name'];
        $isUpdateCategory->price = $data['price'];
        $isUpdateCategory->description = $data['description'];
        $isUpdateCategory->save();
        return $isUpdateCategory;
    }

    // public function findZoneById($uuid)
    // {
    //     $id = uuidtoid($uuid, 'categories');
    //     return Category::find($id);
    // }
}


// "category_id" => "1"
//   "name" => "Go to the login.blade.php file in following path: resources/views/auth/login.blade.php."
//   "price" => "2"
//   "description
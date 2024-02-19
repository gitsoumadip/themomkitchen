<?php

namespace App\Services\Menu;

use App\Contracts\Items\ItemContracts;
use App\Contracts\Menu\MenuContracts;
use App\Models\Category;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class MenuService implements MenuContracts
{
    public function getAll()
    {
        $data = Menu::with('types', 'items')->get();
        return $data;
    }

    public function createMenu($datas)
    {
        // dd($datas);
        $typId = $datas['type'];
        $isCreateCategory = [];
        foreach ($datas['itemId'] as $key => $data) {

            $isCreateCategory[] = [
                'type_id' => $typId,
                'item_id' => $data
            ];
        }

        // dd($isCreateCategory);
        $create=Menu::insert($isCreateCategory);
        return $create;
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

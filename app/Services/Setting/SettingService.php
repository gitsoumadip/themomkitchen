<?php

namespace App\Services\Setting;

use App\Contracts\Location\LocationContracts;
use App\Contracts\Setting\SettingContracts;
use App\Models\Category;
use App\Models\DeliveryPrice;
use App\Models\Setting\Setting;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class SettingService implements SettingContracts
{

    public function getAll()
    {
        $data = Setting::where('is_active', 1)->get();
        return $data;
    }
    public function getCheckoutAll()
    {
        $data = DeliveryPrice::first();
        return $data;
    }
    public function updateSetting($data)
    {
        // dd($data);
        $id = $data['uuid'];
        $isCreateCategory = DeliveryPrice::where('id', $id)->first();
        $isCreateCategory->gst_restaurant = $data['gst_restaurant'];
        $isCreateCategory->delivery_patner_km = $data['delivery_patner_km'];
        $isCreateCategory->delivery_patner_fee = $data['delivery_patner_fee'];
        $isCreateCategory->packing_charge = $data['packing_charge'];
        $isCreateCategory->save();
        return $isCreateCategory;
    }
    public function createSetting($data)
    {
        $id = $data['uuid'];
        if ($data['uuid'] != null) {
            $isCreateCategory = DeliveryPrice::where('id', $id)->first();
        } else {
            $isCreateCategory = new DeliveryPrice();
        }
        $isCreateCategory->gst_restaurant = $data['gst_restaurant'];
        $isCreateCategory->delivery_patner_km = $data['delivery_patner_km'];
        $isCreateCategory->delivery_patner_fee = $data['delivery_patner_fee'];
        $isCreateCategory->packing_charge = $data['packing_charge'];
        $isCreateCategory->save();

        return $isCreateCategory;
    }




    // public function getAll()
    // {
    //     $data = Category::where('is_active', 1)->get();
    //     return $data;
    // }
    // public function createType($data)
    // {
    //     // dd($data);
    //     $isCreateCategory = Type::create([
    //         'categorie_id' => $data['category_id'],
    //         'name' => $data['name'],
    //         'description' => $data['description']
    //     ]);
    //     return $isCreateCategory;
    // }

    // public function updateCategory($data)
    // {
    //     $id = uuidtoid($data['uuid'], 'categories');
    //     $isUpdateCategory = Category::where('id', $id)->first();
    //     $isUpdateCategory->name = $data['name'];
    //     $isUpdateCategory->description = $data['description'];
    //     $isUpdateCategory->save();
    //     return $isUpdateCategory;
    // }

    // public function findZoneById($uuid)
    // {
    //     $id = uuidtoid($uuid, 'categories');
    //     return Category::find($id);
    // }
}

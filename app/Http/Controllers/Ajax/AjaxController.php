<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProfileClinic;
use App\Models\Schedule;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends BaseController
{
    public function setStatus(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->all());
            $table = $request->find;
            $data = $request->value;
            switch ($table) {
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::where('id', $id)->update(['is_active' => $request->is_active]);
                    $message = 'Users Status updated';
                    break;
                case 'types':
                    $id = $request->uuid;
                    $data = Type::where('id', $id)->update(['is_active' => $request->is_active]);
                    $message = 'Users Status updated';
                    break;
                case 'typess':
                    $id = $request->uuid;
                    $data = Type::where('id', $id)->update(['is_avalible' => $request->is_active]);
                    $message = 'Users Status updated';
                    break;
                default:
                    return $this->responseJson(false, 200, 'Something Wrong Happened');
            }
            if ($data) {
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Wrong Happened');
            }
        }
        abort(405);
    }

    public function deliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            // dd($request->all());
            $table = $request->find;
            $data = $request->value;
            switch ($table) {
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::where('id', $id)->update(['is_active' => $request->is_active]);
                    $message = 'Users Status updated';
                    break;
                default:
                    return $this->responseJson(false, 200, 'Something Wrong Happened');
            }
            if ($data) {
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Wrong Happened');
            }
        }
        abort(405);
    }
    public function deleteData(Request $request)
    {
        if ($request->ajax()) {
            $table = $request->find;
            switch ($table) {
                case 'categories':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Category::where('id', $id)->delete();
                    $message = 'Category Deleted';
                    break;
                case 'carts':
                    $id = $request->uuid;
                    $data = Cart::where('id', $id)->delete();
                    $message = 'Cart Deleted';
                    break;
                    // case 'profile_clinics':
                    // $id = uuidtoid($request->uuid, $table);
                    // $data = ProfileClinic::where('id', $id)->delete();
                    // $message = 'Profile Clinic Deleted';
                    // break;
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::where('id', $id)->delete();
                    $message = 'User Deleted';
                    break;
                    // case 'schedules':
                    // $id = $request->uuid;
                    // $data = Schedule::where('id', $id)->delete();
                    // $message = 'Schedule Deleted';
                    // break;
            }
            if (isset($data)) {
                return $this->responseJson(true, 200, $message);
            } else {
                $err_message = $message ? $message : "We are facing some technical issue now. Please try again after some time";
                return $this->responseJson(false, 500, $err_message);
            }
        } else {
            abort(405);
        }
    }

    public function orderStatus(Request $request)
    {
        if ($request->ajax()) {
            $is_active = $request->status;
            $id = $request->userid;
            // dd($is_active);
            $data = Order::where('id', $id)->update(['is_active' => $is_active]);
            $message = 'Order Status updated';
            if ($data) {
                return $this->responseJson(true, 200, $message, $data);
            } else {
                return $this->responseJson(false, 200, 'Something Wrong Happened');
            }
        }
    }
}

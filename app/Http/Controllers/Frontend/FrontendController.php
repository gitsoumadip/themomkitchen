<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\deliveryAddress;
use App\Models\DeliveryPrice;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\Type;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends BaseController
{
    private $AuthContract;
    private $CategoryContract;
    private $TypeContracts;
    public function __construct(AuthContract $AuthContract, CategoryContracts $CategoryContract, TypeContracts $TypeContracts)
    {
        $this->AuthContract = $AuthContract;
        $this->CategoryContract = $CategoryContract;
        $this->TypeContracts = $TypeContracts;
    }

    public function index()
    {
        $fetch = auth()->user();
        return view('frontend.home.index', compact('fetch'));
    }

    public function menu()
    {
        $this->setPageTitle('Menu Type');
        $fetchTypeList = $this->TypeContracts->getAll();
        $fetchAdditionalTypeList = $this->CategoryContract->getAdditionalType();
        // dd($fetchTypeList);
        return view('frontend.menu.index', compact('fetchTypeList', 'fetchAdditionalTypeList'));
    }

    public function cart()
    {
        // dd('gfdsa');
        if (isset(auth()->user()->id)) {
            $uid = auth()->user()->id;
            $fetchCartItem = Cart::with('types', 'users')->where('user_id', $uid)->get();
            return view('frontend.cart.index', compact('fetchCartItem'));
        }
        return view('frontend.cart.index');
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $uid = auth()->user()->id;
        $datasss = $this->TypeContracts->findById($request->id);
        $fetchCartItem = Cart::where(['type_id' => $datasss->id, 'user_id' => $uid])->first();
        // dd($datasss);
        if ($fetchCartItem) {
            $isUpdate = Cart::where('id', $fetchCartItem->id)->update([
                'qty' => $fetchCartItem->qty + 1
            ]);
        } else {
            $isCreateCart = Cart::create([
                'user_id' => $uid,
                'type_id' => $datasss->id,
                'qty' => 1,
                'price' => $datasss->price,
                'total_price' => $datasss->price,

            ]);
        }
        return $isCreateCart;
    }

    public function updateQuantity(Request $request)
    {
        // dd($request->all());
        // $cart = $request->session()->get('cart', []);
        $newQty = $request->newQty;
        $typeId = $request->typeId;
        $fetchItem = Cart::with('types')->where('id', $typeId)->first();
        $totalPrice = $fetchItem->price * $newQty;
        // dd($totalPrice);
        if ($newQty <= 0) {
            $isUpdate = Cart::where('id', $typeId)->delete();
        } else {
            $isUpdate = Cart::where('id', $typeId)->update([
                'qty' => $newQty,
                'total_price' => $totalPrice,
            ]);
        }
        return $isUpdate;
    }

    private function calculateSubtotal($cart)
    {
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['quantity'] * $item['price'];
        }

        return $subtotal;
    }

    public function itemOrder(Request $request)
    {

        // dd($request->all());
        $uid = auth()->user()->id;
        $shippingAddress = $request->shippingAddress;

        $orders = new Order();
        $orders->order_no = generateUniqueOrderNo(); // You need to define a function to generate a unique order number
        $orders->delivery_addresses_id = $shippingAddress;
        $orders->user_id = $uid;
        $orders->qty = $request->totalitemQty;
        $orders->gst_restaurant_charge = $request->gst_resturant;
        $orders->delivery_charge = $request->distanceCharge;
        $orders->packing_charge = $request->packaging;
        $orders->total_price = $request->totalPrice;
        $orders->save();
        $orderId = $orders->id;
        // dd($request->itemQty);
        for ($i = 0; $i < count($request->itemType); $i++) {
            $typeId = $request->itemType[$i];
            $qty = $request->itemQty[$i];
            $price = $request->price[$i];

            $fetchCartItem = orderDetails::where(['type_id' => $typeId, 'user_id' => $uid])->first();

            if ($fetchCartItem) {
                $fetchCartItem->update([
                    'qty' => $fetchCartItem->qty + $qty  // Increment by $qty, not just 1
                ]);
            } else {
                $order = new OrderDetails();
                // $order->order_no = generateUniqueOrderNo(); // You need to define a function to generate a unique order number
                $order->type_id = $typeId;
                $order->order_id = $orderId;
                $order->qty = $qty;
                $order->price = $price;
                $order->total_price = $price * $qty;
                $order->user_id = $uid;
                $order->is_active = 0;
                $order->save();
            }
        }
        Cart::where('user_id', $uid)->delete();

        return $this->responseRedirect('order.dalivery-address.list', 'Item(s) created successfully', 'success', false);
    }

    public function daliveryAddressAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($request->all());
            $uid = auth()->user()->id;
            $isCreated = deliveryAddress::create([
                'user_id' => $uid,
                'name' => $request->name,
                'phone' => $request->phone,
                'alter_phone' => $request->alter_phone,
                'address' => $request->address,
                'pincode' => $request->pincode,
                'city' => $request->city,
                'state' => $request->state,
                'landmark' => $request->landmark,
                'type' => $request->type,
            ]);
            // dd($isCreated);
            return $this->responseRedirect('order.dalivery-address.address-list', 'Item(s) created successfully', 'success', false);
        }
        return view('frontend.order.dalivery-address.add-edit');
    }

    public function changeDaliveryAddressList(Request $request)
    {
        $uid = auth()->user()->id;
        $isFetch = deliveryAddress::where('user_id', $uid)->get();
        if ($request->isMethod('post')) {
            // dd($isFetch->toArray());
            foreach ($isFetch as $key => $data) {
                // dd($request->shippingAddress);
                if ($data->id == $request->shippingAddress) {
                    $iupdate = deliveryAddress::where('id', $data->id)->update([
                        'is_active' => 1
                    ]);
                } else {
                    $iupdate = deliveryAddress::where('id', $data->id)->update([
                        'is_active' => 0
                    ]);
                }
            }
            return $this->responseRedirect('order.dalivery-address.list', 'Item(s) created successfully', 'success', false);
        }

        $fetchCartItem = Cart::with('types', 'users')->where('user_id', $uid)->get();
        return view('frontend.order.dalivery-address.address-list', compact('isFetch', 'fetchCartItem'));
    }

    public function daliveryAddressList(Request $request)
    {
        $uid = auth()->user()->id;
        $fetchCartItem = Cart::with('types', 'users')->where('user_id', $uid)->get();
        $isFetch = deliveryAddress::where('user_id', $uid)->where('is_active', 1)->get();
        $isFetchDeliveryPrice = DeliveryPrice::first();
        // dd($fetchCartItem);
        return view('frontend.order.dalivery-address.index', compact('isFetch', 'fetchCartItem', 'isFetchDeliveryPrice'));
    }

    // public function registration()
    // {
    //     return view('frontend.auth.registration');
    // }

    // public function login()
    // {
    //     return view('frontend.auth.login');
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->responseRedirect('home', 'You have logged out successfully!', 'success');
    }
}

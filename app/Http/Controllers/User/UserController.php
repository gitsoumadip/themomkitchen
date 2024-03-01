<?php

namespace App\Http\Controllers\User;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Menu\MenuContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    private $authContract;
    private $categoryContract;
    private $typeContracts;
    private $itemContracts;
    private $menuContracts;

    public function __construct(
        AuthContract $authContract,
        CategoryContracts $categoryContract,
        TypeContracts $typeContracts,
        ItemContracts $itemContracts,
        MenuContracts $menuContracts
    ) {
        $this->authContract = $authContract;
        $this->categoryContract = $categoryContract;
        $this->typeContracts = $typeContracts;
        $this->itemContracts = $itemContracts;
        $this->menuContracts = $menuContracts;
    }

    public function list(Request $request)
    {
        return view('user.dashboard.index');
    }
    public function edit(Request $request)
    {
    }



    // User 
    public function profile(Request $request)
    {
        return view('user.profile.index');
    }

    public function home()
    {
        return view('user.dashboard.dashboard');
    }

    public function myOrder(Request $request)
    {

        $this->setPageTitle('Order');
        // if ($request->isMethod('post')) {
        //     DB::beginTransaction();
        //     try {
        //         // dd($request->all());
        //         // if (isset($request->uuid)) {
        //         //     $insertArry = $request->except(['_token', '_method']);
        //         //     $isCategoryCreated = $this->menuContracts->updateMenu($insertArry);
        //         // } else {

        //         //     $insertArry = $request->except(['_token', '_method', 'id']);
        //         //     $isCategoryCreated = $this->menuContracts->createMenu($insertArry);
        //         // }
        //         // if ($isCategoryCreated) {
        //         //     DB::commit();
        //         //     return $this->responseRedirect('admin.item.list', 'Item Created Successfully', 'success', false);
        //         // }

        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
        //         return $this->responseRedirectBack('Something went wrong', 'error', true);
        //     }
        // }
        $fetchUser = auth()->user()->id;
        $fetchOrder = Order::where('user_id', $fetchUser)->where('is_active', 0)->get();
        return view('user.order.index', compact('fetchOrder'));
    }
}

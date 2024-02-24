<?php

namespace App\Http\Controllers\User;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
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
        return view('user.order.index');
    }
}

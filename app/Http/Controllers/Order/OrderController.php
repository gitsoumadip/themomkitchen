<?php

namespace App\Http\Controllers\Order;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Menu\MenuContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
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
    public function index()
    {
        $this->setPageTitle('Add Type');
        // $fetchMenu = $this->menuContracts->getAll();
        return view('admin.order.index');
    }
    public function add(Request $request)
    {
        $this->setPageTitle('Add Type');
    }
}

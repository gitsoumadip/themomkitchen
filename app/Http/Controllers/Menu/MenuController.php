<?php

namespace App\Http\Controllers\Menu;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Menu\MenuContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends BaseController
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setPageTitle('Add Type');
        $fetchMenu = $this->menuContracts->getAll();
        return view('admin.menu.index', compact('fetchMenu'));
    }
    public function add(Request $request)
    {
        $this->setPageTitle('Add Type');
        $datas = Item::where('is_active', 1)->get();
        if ($request->isMethod('post')) {
            // dd($request->all());
            // $request->validate([
            //     'type' => 'required',
            // ]);

            DB::beginTransaction();
            try {
                // dd($request->all());
                if (isset($request->uuid)) {
                    $insertArry = $request->except(['_token', '_method']);
                    $isCategoryCreated = $this->menuContracts->updateMenu($insertArry);
                } else {

                    $insertArry = $request->except(['_token', '_method', 'id']);
                    $isCategoryCreated = $this->menuContracts->createMenu($insertArry);
                }
                if ($isCategoryCreated) {
                    DB::commit();
                    return $this->responseRedirect('admin.item.list', 'Item Created Successfully', 'success', false);
                }
            } catch (\Illuminate\Validation\ValidationException $e) {
                DB::rollBack();
                return $this->responseRedirectBack($e->getMessage(), 'error', true);
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
        }

        return view('admin.menu.add-edit', compact('datas'));
    }
    public function edit($id)
    {
        $data = Type::with('items')->where('id', $id)->first();
        return view('admin.menu.add-edit', compact('data'));
    }
}

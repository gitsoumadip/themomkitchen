<?php

namespace App\Http\Controllers\Item;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends BaseController
{
    private $authContract;
    private $categoryContract;
    private $typeContracts;
    private $itemContracts;

    public function __construct(
        AuthContract $authContract,
        CategoryContracts $categoryContract,
        TypeContracts $typeContracts,
        ItemContracts $itemContracts
    ) {
        $this->authContract = $authContract;
        $this->categoryContract = $categoryContract;
        $this->typeContracts = $typeContracts;
        $this->itemContracts = $itemContracts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setPageTitle('Add Type');
        $fetchItem = $this->itemContracts->getAll();
        return view('admin.items.index', compact('fetchItem'));
    }

    public function add(Request $request)
    {
        $this->setPageTitle('Add Type');

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
            ]);

            DB::beginTransaction();

            try {
                if ($request->uuid) {
                    $insertArry = $request->except(['_token', '_method']);
                    $isUpdateCreated = $this->itemContracts->updateItem($insertArry);
                    // dd($isUpdateCreated);
                    if ($isUpdateCreated) {
                        DB::commit();
                        return $this->responseRedirect('admin.item.list', 'Item Update Successfully', 'success', false);
                    }
                } else {
                    // $insertArry = $request->only(['name']); // Use only() instead of except()
                    $insertArry = $request->except(['_token', '_method', 'id']);
                    $isCategoryCreated = $this->itemContracts->createItem($insertArry);

                    if ($isCategoryCreated) {
                        DB::commit();
                        return $this->responseRedirect('admin.item.list', 'Item Created Successfully', 'success', false);
                    }
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

        return view('admin.items.add-edit');
    }

    public function menuItem()
    {
        return view('admin.menu-item.index');
    }
    public function edit($uuid)
    {
        $this->setPageTitle('Edit Item');
        $data = $this->itemContracts->fidnById($uuid);
        return view('admin.items.add-edit', compact('data'));
    }
}

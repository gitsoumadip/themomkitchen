<?php

namespace App\Http\Controllers\Setting;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Menu\MenuContracts;
use App\Contracts\Setting\SettingContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends BaseController
{
    private $authContract;
    private $categoryContract;
    private $typeContracts;
    private $itemContracts;
    private $menuContracts;
    private $SettingContracts;

    public function __construct(
        AuthContract $authContract,
        CategoryContracts $categoryContract,
        TypeContracts $typeContracts,
        ItemContracts $itemContracts,
        MenuContracts $menuContracts,
        SettingContracts $SettingContracts,
    ) {
        $this->authContract = $authContract;
        $this->categoryContract = $categoryContract;
        $this->typeContracts = $typeContracts;
        $this->itemContracts = $itemContracts;
        $this->menuContracts = $menuContracts;
        $this->SettingContracts = $SettingContracts;
    }
    public function index()
    {
        return view('admin.setting.checkout.index');
    }
    public function add(Request $request)
    {
        $this->setPageTitle('Add Type');
        if ($request->isMethod('post')) {
            // dd($request->all());
            DB::beginTransaction();
            try {
                // dd($request->all());
                if (isset($request->uuid)) {
                    $insertArry = $request->except(['_token', '_method']);
                    $isCategoryCreated = $this->SettingContracts->updateSetting($insertArry);
                } else {
                    $insertArry = $request->except(['_token', '_method', 'id']);
                    $isCategoryCreated = $this->SettingContracts->createSetting($insertArry);
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

        return view('admin.setting.checkout.add-edit');
    }
}

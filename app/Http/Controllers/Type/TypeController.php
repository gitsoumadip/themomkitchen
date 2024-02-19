<?php

namespace App\Http\Controllers\Type;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeController extends BaseController
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
        $this->setPageTitle('Add Type');
        $fetchTypeList = $this->TypeContracts->getAll();
        return view('admin.type.index', compact('fetchTypeList'));
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
                // if ($request->uuid) {
                //     $insertArry = $request->except(['_token', '_method']);
                //     $isUpdateCreated = $this->CategoryContract->updateCategory($insertArry);
                //     // dd($isUpdateCreated);
                //     if ($isUpdateCreated) {
                //         DB::commit();
                //         return $this->responseRedirect('admin.category.list', 'Category Update Successfully', 'success', false);
                //     }
                // } else {
                $insertArry = $request->except(['_token', '_method', 'id']);
                $isCategoryCreated = $this->TypeContracts->createType($insertArry);
                if ($isCategoryCreated) {
                    DB::commit();
                    return $this->responseRedirect('admin.type.list', 'Type Created Successfully', 'success', false);
                }
                // }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseRedirectBack('Something went wrong', 'error', true);
            }
        }
        return view('admin.type.add-edit');
    }
}

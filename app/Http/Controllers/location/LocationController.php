<?php

namespace App\Http\Controllers\location;

use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Location\LocationContracts;
use App\Contracts\Type\TypeContracts;
use App\Http\Controllers\BaseController;
use App\Models\location\Location;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    private $AuthContract;
    private $CategoryContract;
    private $TypeContracts;
    private $LocationContracts;
    public function __construct(AuthContract $AuthContract, CategoryContracts $CategoryContract, TypeContracts $TypeContracts,LocationContracts $LocationContracts)
    {
        $this->AuthContract = $AuthContract;
        $this->CategoryContract = $CategoryContract;
        $this->TypeContracts = $TypeContracts;
        $this->LocationContracts = $LocationContracts;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "location";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}

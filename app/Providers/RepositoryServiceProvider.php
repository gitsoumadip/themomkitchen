<?php

namespace App\Providers;

use App\Contracts\Admin\AdminContracts;
use App\Contracts\Auth\AuthContract;
use App\Contracts\Category\CategoryContracts;
use App\Contracts\Items\ItemContracts;
use App\Contracts\Location\LocationContracts;
use App\Contracts\Menu\MenuContracts;
use App\Contracts\Type\TypeContracts;
use App\Contracts\UserManagment\UserManagmentContract;
use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use App\Services\Admin\AdminService;
use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Item\ItemService;
use App\Services\Location\LocationService;
use App\Services\Menu\MenuService;
use App\Services\Type\TypeService;
use App\Services\UserManagment\UserManagmentService;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AuthContract::class => AuthService::class,
        AdminContracts::class => AdminService::class,
        CategoryContracts::class => CategoryService::class,
        TypeContracts::class => TypeService::class,
        ItemContracts::class => ItemService::class,
        MenuContracts::class => MenuService::class,
        UserManagmentContract::class => UserManagmentService::class,
        LocationContracts::class => LocationService::class,
    ];
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}

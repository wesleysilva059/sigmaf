<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OccupationRepository::class, \App\Repositories\OccupationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DepartmentRepository::class, \App\Repositories\DepartmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CostCenterRepository::class, \App\Repositories\CostCenterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MakeRepository::class, \App\Repositories\MakeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ModelRepository::class, \App\Repositories\ModelRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VehicleTypeRepository::class, \App\Repositories\VehicleTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VehicleRepository::class, \App\Repositories\VehicleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MaintenanceCategoryRepository::class, \App\Repositories\MaintenanceCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MaintenanceStatusRepository::class, \App\Repositories\MaintenanceStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MachineShopRepository::class, \App\Repositories\MachineShopRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProviderRepository::class, \App\Repositories\ProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CleaningRepository::class, \App\Repositories\CleaningRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlertRepository::class, \App\Repositories\AlertRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MessageRepository::class, \App\Repositories\MessageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OilChangeTypeRepository::class, \App\Repositories\OilChangeTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FilterChangeTypeRepository::class, \App\Repositories\FilterChangeTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FilterChangeRepository::class, \App\Repositories\FilterChangeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OilChangeRepository::class, \App\Repositories\OilChangeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MaintenanceRepository::class, \App\Repositories\MaintenanceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OtherServiceRepository::class, \App\Repositories\OtherServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VehicleModelRepository::class, \App\Repositories\VehicleModelRepositoryEloquent::class);
        //:end-bindings:
    }
}

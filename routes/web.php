<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

	Route::resource('users', 'UsersController');
		//Route::get('/user/create' , 'UsersController@create')->name('user.create');

	Route::resource('permissions', 'PermissionsController');

	Route::resource('occupations', 'OccupationsController');

	Route::resource('departments', 'DepartmentsController');
		Route::get('/departament/create' , 'DepartmentsController@create')->name('department.create');

	Route::resource('vehicles', 'VehiclesController');
		//Route::get('vehicle/create', 'VehiclesController@create')->name('vehicle.create');
		//Route::post('vehicles/{id}', 'VehiclesController@update')->name('vehicles.update');
		Route::get('/getVehicleModels/{make_id}', 'VehiclesController@getVehicleModels');
		Route::get('/getCostCenters/{departmente_id}', 'VehiclesController@getCostCenter');

	Route::resource('providers', 'ProvidersController');
		Route::get('/getCities/{state_id}', 'ProvidersController@getCities');

	Route::resource('costCenters', 'CostCentersController');
		Route::get('/costCenter/create', 'CostCentersController@create')->name('costCenter.create');

	Route::resource('filterChangeTypes', 'FilterChangeTypesController');
		
	Route::resource('oilChangeTypes', 'OilChangeTypesController');

	Route::resource('machineShops', 'MachineShopsController');
		Route::get('/getCities/{state_id}', 'MachineShopsController@getCities');

	Route::resource('maintenanceCategories', 'MaintenanceCategoriesController');

	Route::resource('maintenanceStatuses', 'MaintenanceStatusesController');

	Route::resource('makes', 'MakesController');

	Route::resource('vehicleModels', 'VehicleModelsController');

	Route::resource('maintenances', 'MaintenancesController');
		Route::get('/getCostCenters/{departmente_id}', 'MaintenancesController@getCostCenter');
		Route::get('/historicsPeriod', 'MaintenancesController@historicsPeriod');
		Route::any('/maintenancesSearch', 'MaintenancesController@searchPeriod')->name('maintenances.search');
		Route::any('/historicsPeriodPrint','MaintenancesController@print')->name('maintenances.print');
		Route::get('/historicsByCar', 'MaintenancesController@historicsByCar');
		Route::any('/maintenancesByCarSearch', 'MaintenancesController@search')->name('maintenancesByCar.search');
		Route::any('/historicsPeriodByCarPrint/{id}','MaintenancesController@printByCar')->name('maintenancesByCar.print');
		Route::any('/finishMaintenance','MaintenancesController@finishMaintenance')->name('maintenance.finish');

	Route::resource('vehicleTypes', 'VehicleTypesController');

	Route::resource('oilChanges', 'OilChangesController');

	Route::resource('filterChanges', 'FilterChangesController');

	Route::resource('lubrifications', 'LubrificationsController');

	Route::resource('cleanings', 'CleaningsController');

	Route::resource('employees', 'EmployeesController');

});


    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes


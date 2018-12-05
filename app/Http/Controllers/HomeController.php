<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\MaintenanceRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;
use App\Entities\Maintenance;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    protected $vehicleRepository;
    protected $maintenanceRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleRepository $vehicleRepository,
                                MaintenanceRepository $maintenanceRepository
    )
    {
        $this->middleware('auth');
        $this->vehicleRepository = $vehicleRepository;
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $today = date('Y-m-d');

        $vehicles = $this->vehicleRepository->all();

        $maintenances = Maintenance::where('maintenanceStatus_id','<>',7)->paginate($limit = 4);
        
        $active = $this->vehicleRepository->all()->where('status','0')->count();
        $inMaintenance = $this->vehicleRepository->all()->where('status','2')->count();
        $stopped = $this->vehicleRepository->all()->where('status','1')->count();
        $auction = $this->vehicleRepository->all()->where('status','3')->count();
        
        return view('adminlte::home', compact(  'maintenances',
                                                'today',
                                                'active',
                                                'inMaintenance',
                                                'stopped',
                                                'auction'
                                            ));
    }

    public function chartHome()
    {

        setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
        date_default_timezone_set('America/Sao_Paulo');

        
        $active = $this->vehicleRepository->all()->where('status','0')->count();
        $inMaintenance = $this->vehicleRepository->all()->where('status','2')->count();
        $stopped = $this->vehicleRepository->all()->where('status','1')->count();
        $auction = $this->vehicleRepository->all()->where('status','3')->count();
   
        $status = collect(
                    [
                        'active' => $active,
                        'inMaintenance' => $inMaintenance,
                        'stopped' => $stopped,
                        'auction' => $auction
                    ]);

        return response()->json($status);
    }
}

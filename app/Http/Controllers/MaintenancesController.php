<?php

namespace App\Http\Controllers;

use App\Entities\Maintenance;
use App\Http\Requests;
use App\Http\Requests\MaintenanceCreateRequest;
use App\Http\Requests\MaintenanceUpdateRequest;
use App\Repositories\CostCenterRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\MachineShopRepository;
use App\Repositories\MaintenanceCategoryRepository;
use App\Repositories\MaintenanceRepository;
use App\Repositories\MaintenanceStatusRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\VehicleRepository;
use App\Validators\MaintenanceValidator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class MaintenancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MaintenancesController extends Controller
{
    /**
     * @var MaintenanceRepository
     */
    protected $repository;

    /**
     * @var MaintenanceValidator
     */
    protected $validator;

    /**
     * MaintenancesController constructor.
     *
     * @param MaintenanceRepository $repository
     * @param MaintenanceValidator $validator
     */
    public function __construct(
        MaintenanceRepository $repository, 
        MaintenanceValidator $validator, 
        VehicleRepository $vehicleRepository, 
        DepartmentRepository $departmentRepository, 
        CostCenterRepository $costCenterRepository,
        MaintenanceCategoryRepository $maintenanceCategoryRepository,
        MaintenanceStatusRepository $maintenanceStatusRepository,
        MachineShopRepository $machineShopRepository,
        ProviderRepository $providerRepository
    )

    {
        $this->repository                       = $repository;
        $this->validator                        = $validator;
        $this->departmentRepository             = $departmentRepository;
        $this->costCenterRepository             = $costCenterRepository;
        $this->vehicleRepository                = $vehicleRepository;
        $this->maintenanceCategoryRepository    = $maintenanceCategoryRepository;
        $this->maintenanceStatusRepository      = $maintenanceStatusRepository;
        $this->machineShopRepository            = $machineShopRepository;
        $this->providerRepository               = $providerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $maintenances = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenances,
            ]);
        }

        return view('services.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $currentYear = date('Y');

        $maintenance = $this->repository->first();
        
        if(!is_null($maintenance)){
            $maintenance_cod = $maintenance->cod;
            $part = explode("/", $maintenance_cod);
            if($part[1] == $currentYear)
                $part[0] = $part[0] + 1;
            else
                $part[0] = 1;
            $codNextMaintenance = $part[0]."/".$currentYear;
        }else{
            $codNextMaintenance = "1"."/".$currentYear;
        }


        $maintenanceCategory_list   = $this->maintenanceCategoryRepository->all(['id', 'name']);
        $maintenanceStatus_list     = $this->maintenanceStatusRepository->all(['id', 'name']); 
        $machineShop_list           = $this->machineShopRepository->all(['id', 'name']);
        $provider_list              = $this->providerRepository->all(['id', 'name']); 
        $department_list            = $this->departmentRepository->all(['id','name']);
        $costCenter_list            = $this->costCenterRepository->all(['id','name']);
        $vehicles_list              = $this->vehicleRepository->all();

        return view('services.maintenances.create', compact(
                        'codNextMaintenance', 
                        'currentYear',
                        'department_list',
                        'costCenter_list',
                        'maintenanceCategory_list',
                        'maintenanceStatus_list',
                        'machineShop_list',
                        'provider_list',
                        'vehicles_list'
                    ));
    }

    public function getCostCenter($department_id)
    {
        $costCenters = $this->costCenterRepository->all()->where('department_id',$department_id);
        sleep(1);
        return response()->json($costCenters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MaintenanceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MaintenanceCreateRequest $request)
    {
        //dd($request);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $maintenance = $this->repository->create($request->all());

            $response = [
                'message' => 'Maintenance created.',
                'data'    => $maintenance->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenance,
            ]);
        }

        return view('services.maintenances.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintenance = $this->repository->find($id);

        return view('services.maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MaintenanceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MaintenanceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $maintenance = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Maintenance updated.',
                'data'    => $maintenance->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Maintenance deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Maintenance deleted.');
    }

    public function historicsPeriod()
    {
        $historics = $this->repository->orderBy('initDateMaintenance','desc')->paginate($limit = 15, $columns = ['*']);


        return view('reports.services.maintenances.index', compact('historics'));
    }

    public function searchPeriod(Request $request, Maintenance $maintenances)
    {
        $dataForm = $request->except('_token');

        $historics = $maintenances->search($dataForm, '15');

        return view('reports.services.maintenances.index', compact('historics', 'dataForm'));
    }

    public function print(Request $request, Maintenance $maintenances)
    {
        $dataForm = $request->except('_token');

        if(isset($dataForm['date_init'])){
            $Date_init = explode('-', $dataForm['date_init']);
            $date_init = $Date_init[2]. '/' . $Date_init[1] . '/' . $Date_init[0];    
        } else {
            $date_init = 'NULL';
        }
        
        if(isset($dataForm['date_end'])){
            $Date_end = explode('-', $dataForm['date_end']);
            $date_end = $Date_end[2]. '/' . $Date_end[1] . '/' . $Date_end[0];
        } else {
            $date_end = 'NULL';
        }
                

        $historics = $maintenances->search($dataForm, '15');

        $today = date('Y-m-d');
        $today = explode('-', $today);
        $today = $today[2]. '/' . $today[1] . '/' . $today[0];

        $pdf = PDF::loadView('reports.services.maintenances.print', compact('historics','today','date_init', 'date_end'));

        return $pdf->stream();
    }

    public function historicsByCar()
    {
        $historics = $this->repository->orderBy('initDateMaintenance','desc')->paginate($limit = 15, $columns = ['*']);


        return view('reports.services.maintenancesByCar.index', compact('historics'));
    }

    public function search(Request $request, Maintenance $maintenances)
    {
        $dataForm = $request->except('_token');

        $historics = $maintenances->searchByCar($dataForm, '15');

        return view('reports.services.maintenancesByCar.index', compact('historics', 'dataForm'));
    }

    public function printByCar($id)
    {
        $maintenance = $this->repository->find($id);
        //dd($maintenance);
        $today = date('Y-m-d');
        $today = explode('-', $today);
        $today = $today[2]. '/' . $today[1] . '/' . $today[0];

        $pdf = PDF::loadView('reports.services.maintenancesByCar.print', compact('maintenance','today'));

        return $pdf->stream();
    }
}

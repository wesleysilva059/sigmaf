<?php

namespace App\Http\Controllers;

use App\Entities\Insurance;
use App\Entities\Specification;
use App\Entities\Vehicle;
use App\Http\Requests;
use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Repositories\CostCenterRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\MakeRepository;
use App\Repositories\VehicleModelRepository;
use App\Repositories\VehicleRepository;
use App\Repositories\VehicleTypeRepository;
use App\Services\VehicleService;
use App\Validators\VehicleValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class VehiclesController.
 *
 * @package namespace App\Http\Controllers;
 */
class VehiclesController extends Controller
{
    /**
     * @var VehicleRepository
     */
    protected $repository;

    /**
     * @var VehicleValidator
     */
    protected $validator;

    /**
     * @var VehicleService
     */
    protected $service;

    protected $makeRepository;
    protected $vehicleTypeRepository;
    protected $departmentRepository;
    protected $costCenterRepository;
    /**
     * VehiclesController constructor.
     *
     * @param VehicleRepository $repository
     * @param VehicleValidator $validator
     * @param VehicleService $service
     */
    public function __construct(VehicleRepository $repository, VehicleValidator $validator, VehicleService $service, MakeRepository $makeRepository, VehicleTypeRepository $vehicleTypeRepository, DepartmentRepository $departmentRepository, CostCenterRepository $costCenterRepository, VehicleModelRepository $vehicleModel)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
        $this->makeRepository = $makeRepository;
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->costCenterRepository = $costCenterRepository;
        $this->vehicleModel = $vehicleModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        
        $vehicles = $this->repository->all();
        //$vehicles = Vehicle::with('costCenter')->get();
        //dd($vehicles);

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        $currentYear = date('Y');

        $vehicles = $this->repository->first();
        
        if(!is_null($vehicles)){
            $idNextVehicle = $vehicles->id + 1;
        }else{
            $idNextVehicle = 1;
        }

        $make_list = $this->makeRepository->all(['id','name']);

        $vehicleType_list = $this->vehicleTypeRepository->all(['id','name']);

        $department_list = $this->departmentRepository->all(['id','name']);

        $costCenter_list = $this->costCenterRepository->all(['id','name']);

        return view('vehicles.create', compact(
                        'idNextVehicle', 
                        'currentYear',
                        'make_list',
                        'vehicleType_list',
                        'department_list',
                        'costCenter_list'
                    ));
    }

    public function getVehicleModels($make_id)
    {
        $vehicleModels = $this->vehicleModel->all()->where('make_id',$make_id);
        sleep(1);
        return response()->json($vehicleModels);
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
     * @param  VehicleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VehicleCreateRequest $request)
    {
        dd($request);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $vehicle = new Vehicle();
            $vehicle->vehiclePlate = $request->get('vehiclePlate');
            $vehicle->vehicleColor = $request->get('vehicleColor');
            $vehicle->yearManufactory = $request->get('yearManufactory');
            $vehicle->yearModel = $request->get('yearModel');
            $vehicle->purchaseDate = $request->get('purchaseDate');
            $vehicle->renavam = $request->get('renavam');
            $vehicle->chassis = $request->get('chassis');
            $vehicle->typeFuel = $request->get('typeControl');
            $vehicle->typeControl = $request->get('typeFuel');
            $vehicle->status = $request->get('status');
            $vehicle->vehicleModel_id = $request->get('vehicleModel_id');
            $vehicle->costCenter_id = $request->get('costCenter_id');
            $vehicle->vehicleType_id = $request->get('vehicleType_id');
            $vehicle->comments = $request->get('comments');
            $vehicle->save();
            
            $insurance = new Insurance();
            $insurance->vehicle_id = $vehicle->id;
            $insurance->numInsurancePolicy = $request->get('numInsurancePolicy');
            $insurance->insurer = $request->get('insurer');
            $insurance->insuranceBroker = $request->get('insuranceBroker');
            $insurance->value = $request->get('value');
            $insurance->initEffectiveDate = $request->get('initEffectiveDate');
            $insurance->endEffectiveDate = $request->get('endEffectiveDate');
            $insurance->save();

            $specification = new Specification();
            $specification->vehicle_id = $vehicle->id;
            $specification->engine = $request->get('engine');
            $specification->engineNumber = $request->get('engineNumber');
            $specification->tireWeight = $request->get('tireWeight');
            $specification->frontTires = $request->get('frontTires');
            $specification->backTires = $request->get('backTires');
            $specification->backTires = $request->get('backTires');
            $specification->protector = $request->get('protector');
            $specification->innerTires = $request->get('innerTires');
            $specification->frontCanvasPad = $request->get('frontCanvasPad');
            $specification->backCanvasPad = $request->get('backCanvasPad');
            $specification->frontTambor = $request->get('frontTambor');
            $specification->backTambor = $request->get('backTambor');
            $specification->frontBumper = $request->get('frontBumper');
            $specification->backBumper = $request->get('backBumper');
            $specification->vehicleBodywork = $request->get('vehicleBodywork');
            $specification->spring = $request->get('spring');
            $specification->currentKmHr = $request->get('currentKmHr');
            $specification->save();

            $response = [
                'message' => 'Vehicle created.',
                'data'    => $vehicle->toArray(),
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
        $vehicle = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $vehicle,
            ]);
        }

        return view('vehicles.show', compact('vehicle'));
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
        $vehicle = $this->repository->find($id);

        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VehicleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VehicleUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $vehicle = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Vehicle updated.',
                'data'    => $vehicle->toArray(),
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
                'message' => 'Vehicle deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Vehicle deleted.');
    }
}

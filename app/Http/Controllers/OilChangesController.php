<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\OilChangeCreateRequest;
use App\Http\Requests\OilChangeUpdateRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\MaintenanceStatusRepository;
use App\Repositories\OilChangeRepository;
use App\Repositories\OilChangeTypeRepository;
use App\Repositories\VehicleRepository;
use App\Validators\OilChangeValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class OilChangesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OilChangesController extends Controller
{
    /**
     * @var OilChangeRepository
     */
    protected $repository;
    protected $vehicleRepository;
    protected $maintenanceStatusRepository;
    protected $employeeRepository;
    protected $oilChangeTypeRepository;

    /**
     * @var OilChangeValidator
     */
    protected $validator;

    /**
     * OilChangesController constructor.
     *
     * @param OilChangeRepository $repository
     * @param OilChangeValidator $validator
     */
    public function __construct(OilChangeRepository $repository, 
                                OilChangeValidator $validator, 
                                VehicleRepository $vehicleRepository, 
                                MaintenanceStatusRepository $maintenanceStatusRepository,
                                EmployeeRepository $employeeRepository,
                                OilChangeTypeRepository $oilChangeTypeRepository
                            )
    {
        $this->repository                   = $repository;
        $this->validator                    = $validator;
        $this->vehicleRepository            = $vehicleRepository;
        $this->maintenanceStatusRepository  = $maintenanceStatusRepository;
        $this->employeeRepository           = $employeeRepository;
        $this->oilChangeTypeRepository      = $oilChangeTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $oilChanges = $this->repository->all();

        //$nextOilChange = $oilChanges->currentKmHr + $oilChanges->periodOilChange;
        //dd($nextOilChange);

        return view('services.oilChanges.index', compact('oilChanges'));
    }

    public function create()
    {

        $oilChange = $this->repository->first();
        
        if(!is_null($oilChange)){
            $idNextOilChange = $oilChange->id + 1;
        }else{
            $idNextOilChange = 1;
        }

        $vehicles_list              = $this->vehicleRepository->all();
        $maintenanceStatus_list     = $this->maintenanceStatusRepository->all(['id', 'name']);
        $employees_list             = $this->employeeRepository->all(['id', 'name']);
        $oilChangeType_list         = $this->oilChangeTypeRepository->all(['id','name']); 

        return view('services.oilChanges.create', compact(
                                                    'vehicles_list', 
                                                    'maintenanceStatus_list', 
                                                    'employees_list', 
                                                    'oilChangeType_list',
                                                    'idNextOilChange'
                                                ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OilChangeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OilChangeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $oilChange = $this->repository->create($request->all());

            $response = [
                'message' => 'OilChange created.',
                'data'    => $oilChange->toArray(),
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
        $oilChange = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $oilChange,
            ]);
        }

        return view('services.oilChanges.show', compact('oilChange'));
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
        $oilChange = $this->repository->find($id);

        return view('services.oilChanges.edit', compact('oilChange'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OilChangeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OilChangeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $oilChange = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OilChange updated.',
                'data'    => $oilChange->toArray(),
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
                'message' => 'OilChange deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OilChange deleted.');
    }
}

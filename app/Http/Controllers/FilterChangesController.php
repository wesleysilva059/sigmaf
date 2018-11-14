<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\FilterChangeCreateRequest;
use App\Http\Requests\FilterChangeUpdateRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\FilterChangeRepository;
use App\Repositories\FilterChangeTypeRepository;
use App\Repositories\MaintenanceStatusRepository;
use App\Repositories\VehicleRepository;
use App\Validators\FilterChangeValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class FilterChangesController.
 *
 * @package namespace App\Http\Controllers;
 */
class FilterChangesController extends Controller
{
    /**
     * @var FilterChangeRepository
     */
    protected $repository;
    protected $vehicleRepository;
    protected $maintenanceStatusRepository;
    protected $employeeRepository;
    protected $filterChangeTypeRepository;

    /**
     * @var FilterChangeValidator
     */
    protected $validator;

    /**
     * FilterChangesController constructor.
     *
     * @param FilterChangeRepository $repository
     * @param FilterChangeValidator $validator
     */
    public function __construct(FilterChangeRepository $repository, 
                                FilterChangeValidator $validator,
                                VehicleRepository $vehicleRepository, 
                                MaintenanceStatusRepository $maintenanceStatusRepository,
                                EmployeeRepository $employeeRepository,
                                FilterChangeTypeRepository $filterChangeTypeRepository
                            )
    {
        $this->repository                   = $repository;
        $this->validator                    = $validator;
        $this->vehicleRepository            = $vehicleRepository;
        $this->maintenanceStatusRepository  = $maintenanceStatusRepository;
        $this->employeeRepository           = $employeeRepository;
        $this->filterChangeTypeRepository   = $filterChangeTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $filterChanges = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChanges,
            ]);
        }

        return view('services.filterChanges.index', compact('filterChanges'));
    }

    public function create()
    {

        $filterChange = $this->repository->first();
        
        if(!is_null($filterChange)){
            $idNextFilterChange = $filterChange->id + 1;
        }else{
            $idNextFilterChange = 1;
        }

        $vehicles_list              = $this->vehicleRepository->all();
        $maintenanceStatus_list     = $this->maintenanceStatusRepository->all(['id', 'name']);
        $employees_list             = $this->employeeRepository->all(['id', 'name']);
        $filterChangeType_list         = $this->filterChangeTypeRepository->all(['id','name']); 

        return view('services.filterChanges.create', compact(
                                                    'vehicles_list', 
                                                    'maintenanceStatus_list', 
                                                    'employees_list', 
                                                    'filterChangeType_list',
                                                    'idNextFilterChange'
                                                ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  FilterChangeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FilterChangeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $filterChange = $this->repository->create($request->all());

            $response = [
                'message' => 'FilterChange created.',
                'data'    => $filterChange->toArray(),
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
        $filterChange = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChange,
            ]);
        }

        return view('services.filterChanges.show', compact('filterChange'));
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
        $filterChange = $this->repository->find($id);

        return view('services.filterChanges.edit', compact('filterChange'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FilterChangeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FilterChangeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $filterChange = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'FilterChange updated.',
                'data'    => $filterChange->toArray(),
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
                'message' => 'FilterChange deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FilterChange deleted.');
    }
}

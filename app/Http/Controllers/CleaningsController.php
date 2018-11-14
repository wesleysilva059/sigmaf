<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CleaningCreateRequest;
use App\Http\Requests\CleaningUpdateRequest;
use App\Repositories\CleaningRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\MaintenanceStatusRepository;
use App\Repositories\VehicleRepository;
use App\Validators\CleaningValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CleaningsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CleaningsController extends Controller
{
    /**
     * @var CleaningRepository
     */
    protected $repository;

    /**
     * @var CleaningValidator
     */
    protected $validator;

    /**
     * CleaningsController constructor.
     *
     * @param CleaningRepository $repository
     * @param CleaningValidator $validator
     */
    public function __construct(CleaningRepository $repository, 
                                CleaningValidator $validator,
                                VehicleRepository $vehicleRepository, 
                                EmployeeRepository $employeeRepository
                            )
    {
        $this->repository                   = $repository;
        $this->validator                    = $validator;
        $this->vehicleRepository            = $vehicleRepository;
        $this->employeeRepository           = $employeeRepository;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cleanings = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cleanings,
            ]);
        }

        return view('services.cleanings.index', compact('cleanings'));
    }

    public function create()
    {

        $cleanings = $this->repository->first();
        
        if(!is_null($cleanings)){
            $idNextCleaning = $cleanings->id + 1;
        }else{
            $idNextCleaning = 1;
        }

        $vehicles_list              = $this->vehicleRepository->all();
        $employees_list             = $this->employeeRepository->all(['id', 'name']); 

        return view('services.cleanings.create', compact(
                                                    'vehicles_list',
                                                    'employees_list',
                                                    'idNextCleaning'
                                                ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CleaningCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CleaningCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cleaning = $this->repository->create($request->all());

            $response = [
                'message' => 'Cleaning created.',
                'data'    => $cleaning->toArray(),
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
        $cleaning = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cleaning,
            ]);
        }

        return view('services.cleanings.show', compact('cleaning'));
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
        $cleaning = $this->repository->find($id);

        return view('services.cleanings.edit', compact('cleaning'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CleaningUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CleaningUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cleaning = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cleaning updated.',
                'data'    => $cleaning->toArray(),
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
                'message' => 'Cleaning deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Cleaning deleted.');
    }
}

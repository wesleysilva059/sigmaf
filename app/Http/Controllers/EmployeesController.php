<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\OccupationRepository;
use App\Validators\EmployeeValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class EmployeesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EmployeesController extends Controller
{
    /**
     * @var EmployeeRepository
     */
    protected $repository;

    /**
     * @var EmployeeValidator
     */
    protected $validator;
    protected $occupationRepository;

    /**
     * EmployeesController constructor.
     *
     * @param EmployeeRepository $repository
     * @param EmployeeValidator $validator
     */
    public function __construct(EmployeeRepository $repository, 
                                EmployeeValidator $validator,
                                OccupationRepository $occupationRepository
                            )
    {
        $this->repository           = $repository;
        $this->validator            = $validator;
        $this->occupationRepository = $occupationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $employees = $this->repository->all();

        return view('register.employees.index', compact('employees'));
    }

    public function create()
    {
        $occupation_list = $this->occupationRepository->all(['id','name']);        

        return view('register.employees.create', compact('occupation_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmployeeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EmployeeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $employee = $this->repository->create($request->all());

            $response = [
                'message' => 'Employee created.',
                'data'    => $employee->toArray(),
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
        $employee = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $employee,
            ]);
        }

        return view('register.employees.show', compact('employee'));
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
        $employee = $this->repository->find($id);

        return view('register.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmployeeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $employee = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Employee updated.',
                'data'    => $employee->toArray(),
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
                'message' => 'Employee deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Employee deleted.');
    }
}

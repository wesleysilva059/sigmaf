<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Repositories\DepartmentRepository;
use App\Validators\DepartmentValidator;
use App\Services\DepartmentService;

/**
 * Class DepartmentsController.
 *use App\Http\Requests;
 * @package namespace App\Http\Controllers;
 */
class DepartmentsController extends Controller
{
    protected $repository;

    protected $validator;

    protected $service;

    public function __construct(DepartmentRepository $repository, DepartmentValidator $validator, DepartmentService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->repository->all();

        return view('register.departments.index', ['departments' => $departments]);
    }

    public function create()
    {
        return view('register.departments.create');
    }

   public function store(DepartmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $department = $this->repository->create($request->all());

            $response = [
                'message' => 'department created.',
                'data'    => $department->toArray(),
            ];

            return redirect()->route('departments.index')->with('success','Departamento Cadastrado com Sucesso!');
        } catch (ValidatorException $e) {
            
            return redirect()->back()->with('erro','Falha ao Cadastrar Departamento!');
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
        $department = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $department,
            ]);
        }

        return view('departments.show', compact('department'));
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
        $department = $this->repository->find($id);

        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  departmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DepartmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $department = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'department updated.',
                'data'    => $department->toArray(),
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
                'message' => 'department deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('departments.index');
    }
}



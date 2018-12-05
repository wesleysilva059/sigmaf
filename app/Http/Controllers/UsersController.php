<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\DepartmentRepository;
use App\Repositories\OccupationRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Support\dd;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class FornecedorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{

	protected $repository;
    protected $validator;
    protected $service;
    protected $occupationRepository;
    protected $departmentRepository;


    public function __construct(UserRepository $repository, UserValidator $validator, UserService $service, DepartmentRepository $departmentRepository, OccupationRepository $occupationRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
        $this->occupationRepository = $occupationRepository;
        $this->departmentRepository = $departmentRepository;
    }

	public function index()
    {
        $users = $this->repository->all();     
        
        return view('users.index', [
            'users'             => $users,
        ]);
    }



    public function create()
    {
        $department_list = $this->departmentRepository->all(['id','name']);
        $occupation_list = $this->occupationRepository->all(['id','name']);

        return view('users.create', compact('department_list','occupation_list'));
    }

    public function store(UserCreateRequest $data)
    {
        try {

            $this->validator->with($data->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = [
                'name'          => $data['name'],
                'username'      => $data['username'],
                'email'         => $data['email'],
                'password'      => bcrypt($data['password']),
                'registration'  => $data['registration'],
                'birthDate'     => $data['birthDate'],
                'phone'         => $data['phone'],
                'celPhone'      => $data['celPhone'],
                'department_id' => $data['department_id'],
                'occupation_id' => $data['occupation_id'],
                'status'        => $data['status'],
            ];
            
            User::create($user);

            return redirect()->route('users.index')->with('success','Usuario Cadastrado com Sucesso!');
        } catch (ValidatorException $e) {
            
            return redirect()->back()->with('erro','Falha ao Cadastrar Usuario!');
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
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
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
        $user = $this->repository->find($id);
        $department_list = $this->departmentRepository->all(['id','name']);
        $occupation_list = $this->occupationRepository->all(['id','name']);

        return view('users.edit', compact('user','department_list','occupation_list'));
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
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $user = User::find($id);
            $user->name           = $request->get('name');
            $user->username       = $request->get('username');
            $user->email          = $request->get('email');
            $user->password       = bcrypt($request->get('password'));
            $user->registration   = $request->get('registration');
            $user->birthDate      = $request->get('birthDate');
            $user->phone          = $request->get('phone');
            $user->celPhone       = $request->get('celPhone');
            $user->department_id  = $request->get('department_id');
            $user->occupation_id  = $request->get('occupation_id');
            $user->status         = $request->get('status');
            $user->save();

            $response = [
                'message' => 'user updated.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('users.index')->with('success', 'Usuario alterado com sucesso');
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

        return redirect()->route('users.index')->with('success', 'Usuario removido com sucesso');
    }
 }
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VehicleModelCreateRequest;
use App\Http\Requests\VehicleModelUpdateRequest;
use App\Repositories\VehicleModelRepository;
use App\Validators\VehicleModelValidator;

/**
 * Class VehicleModelsController.
 *
 * @package namespace App\Http\Controllers;
 */
class VehicleModelsController extends Controller
{
    /**
     * @var VehicleModelRepository
     */
    protected $repository;

    /**
     * @var VehicleModelValidator
     */
    protected $validator;

    /**
     * VehicleModelsController constructor.
     *
     * @param VehicleModelRepository $repository
     * @param VehicleModelValidator $validator
     */
    public function __construct(VehicleModelRepository $repository, VehicleModelValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $vehicleModels = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $vehicleModels,
            ]);
        }

        return view('register.vehicleModels.index', compact('vehicleModels'));
    }

    public function create()
    {
        return view('register.vehicleModels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VehicleModelCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VehicleModelCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $vehicleModel = $this->repository->create($request->all());

            $response = [
                'message' => 'VehicleModel created.',
                'data'    => $vehicleModel->toArray(),
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
        $vehicleModel = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $vehicleModel,
            ]);
        }

        return view('vehicleModels.show', compact('vehicleModel'));
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
        $vehicleModel = $this->repository->find($id);

        return view('vehicleModels.edit', compact('vehicleModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VehicleModelUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VehicleModelUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $vehicleModel = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VehicleModel updated.',
                'data'    => $vehicleModel->toArray(),
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
                'message' => 'VehicleModel deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VehicleModel deleted.');
    }
}

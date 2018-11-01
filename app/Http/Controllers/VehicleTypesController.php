<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VehicleTypeCreateRequest;
use App\Http\Requests\VehicleTypeUpdateRequest;
use App\Repositories\VehicleTypeRepository;
use App\Validators\VehicleTypeValidator;

/**
 * Class VehicleTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class VehicleTypesController extends Controller
{
    /**
     * @var VehicleTypeRepository
     */
    protected $repository;

    /**
     * @var VehicleTypeValidator
     */
    protected $validator;

    /**
     * VehicleTypesController constructor.
     *
     * @param VehicleTypeRepository $repository
     * @param VehicleTypeValidator $validator
     */
    public function __construct(VehicleTypeRepository $repository, VehicleTypeValidator $validator)
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
        $vehicleTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $vehicleTypes,
            ]);
        }

        return view('register.vehicleTypes.index', compact('vehicleTypes'));
    }

    public function create()
    {

        return view('register.vehicleTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VehicleTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VehicleTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $vehicleType = $this->repository->create($request->all());

            $response = [
                'message' => 'VehicleType created.',
                'data'    => $vehicleType->toArray(),
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
        $vehicleType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $vehicleType,
            ]);
        }

        return view('vehicleTypes.show', compact('vehicleType'));
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
        $vehicleType = $this->repository->find($id);

        return view('vehicleTypes.edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VehicleTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VehicleTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $vehicleType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VehicleType updated.',
                'data'    => $vehicleType->toArray(),
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
                'message' => 'VehicleType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VehicleType deleted.');
    }
}

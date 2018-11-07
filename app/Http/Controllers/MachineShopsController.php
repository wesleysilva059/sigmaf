<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\MachineShopCreateRequest;
use App\Http\Requests\MachineShopUpdateRequest;
use App\Entities\State;
use App\Entities\City;
use App\Repositories\MachineShopRepository;
use App\Validators\MachineShopValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class MachineShopsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MachineShopsController extends Controller
{
    /**
     * @var MachineShopRepository
     */
    protected $repository;

    /**
     * @var MachineShopValidator
     */
    protected $validator;

    /**
     * MachineShopsController constructor.
     *
     * @param MachineShopRepository $repository
     * @param MachineShopValidator $validator
     */
    public function __construct(MachineShopRepository $repository, MachineShopValidator $validator, State $state)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $machineShops = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $machineShops,
            ]);
        }

        return view('register.machineShops.index', compact('machineShops'));
    }

    public function create()
    {
        $state_list = State::all();

        return view('register.machineShops.create', compact('state_list'));
    }

    public function getCities($state_id)
    {
        $cities = City::all()->where('state_id',$state_id);
        sleep(1);
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MachineShopCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MachineShopCreateRequest $request)
    {
        //dd($request);
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $machineShop = $this->repository->create($request->all());



            $response = [
                'message' => 'MachineShop created.',
                'data'    => $machineShop->toArray(),
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
        $machineShop = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $machineShop,
            ]);
        }

        return view('machineShops.show', compact('machineShop'));
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
        $machineShop = $this->repository->find($id);

        return view('machineShops.edit', compact('machineShop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MachineShopUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MachineShopUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $machineShop = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MachineShop updated.',
                'data'    => $machineShop->toArray(),
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
                'message' => 'MachineShop deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MachineShop deleted.');
    }
}

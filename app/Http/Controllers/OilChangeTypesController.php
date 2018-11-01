<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OilChangeTypeCreateRequest;
use App\Http\Requests\OilChangeTypeUpdateRequest;
use App\Repositories\OilChangeTypeRepository;
use App\Validators\OilChangeTypeValidator;

/**
 * Class OilChangeTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OilChangeTypesController extends Controller
{
    /**
     * @var OilChangeTypeRepository
     */
    protected $repository;

    /**
     * @var OilChangeTypeValidator
     */
    protected $validator;

    /**
     * OilChangeTypesController constructor.
     *
     * @param OilChangeTypeRepository $repository
     * @param OilChangeTypeValidator $validator
     */
    public function __construct(OilChangeTypeRepository $repository, OilChangeTypeValidator $validator)
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
        $oilChangeTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $oilChangeTypes,
            ]);
        }

        return view('register.oilChangeTypes.index', compact('oilChangeTypes'));
    }

    public function create()
    {
        return view('register.oilChangeTypes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  OilChangeTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OilChangeTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $oilChangeType = $this->repository->create($request->all());

            $response = [
                'message' => 'OilChangeType created.',
                'data'    => $oilChangeType->toArray(),
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
        $oilChangeType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $oilChangeType,
            ]);
        }

        return view('oilChangeTypes.show', compact('oilChangeType'));
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
        $oilChangeType = $this->repository->find($id);

        return view('oilChangeTypes.edit', compact('oilChangeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OilChangeTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OilChangeTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $oilChangeType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OilChangeType updated.',
                'data'    => $oilChangeType->toArray(),
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
                'message' => 'OilChangeType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OilChangeType deleted.');
    }
}

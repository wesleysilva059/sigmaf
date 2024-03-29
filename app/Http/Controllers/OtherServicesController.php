<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OtherServiceCreateRequest;
use App\Http\Requests\OtherServiceUpdateRequest;
use App\Repositories\OtherServiceRepository;
use App\Validators\OtherServiceValidator;

/**
 * Class OtherServicesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OtherServicesController extends Controller
{
    /**
     * @var OtherServiceRepository
     */
    protected $repository;

    /**
     * @var OtherServiceValidator
     */
    protected $validator;

    /**
     * OtherServicesController constructor.
     *
     * @param OtherServiceRepository $repository
     * @param OtherServiceValidator $validator
     */
    public function __construct(OtherServiceRepository $repository, OtherServiceValidator $validator)
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
        $otherServices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $otherServices,
            ]);
        }

        return view('otherServices.index', compact('otherServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OtherServiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OtherServiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $otherService = $this->repository->create($request->all());

            $response = [
                'message' => 'OtherService created.',
                'data'    => $otherService->toArray(),
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
        $otherService = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $otherService,
            ]);
        }

        return view('otherServices.show', compact('otherService'));
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
        $otherService = $this->repository->find($id);

        return view('otherServices.edit', compact('otherService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OtherServiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OtherServiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $otherService = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OtherService updated.',
                'data'    => $otherService->toArray(),
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
                'message' => 'OtherService deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OtherService deleted.');
    }
}

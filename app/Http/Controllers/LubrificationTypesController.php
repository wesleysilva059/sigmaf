<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LubrificationTypeCreateRequest;
use App\Http\Requests\LubrificationTypeUpdateRequest;
use App\Repositories\LubrificationTypeRepository;
use App\Validators\LubrificationTypeValidator;

/**
 * Class LubrificationTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class LubrificationTypesController extends Controller
{
    /**
     * @var LubrificationTypeRepository
     */
    protected $repository;

    /**
     * @var LubrificationTypeValidator
     */
    protected $validator;

    /**
     * LubrificationTypesController constructor.
     *
     * @param LubrificationTypeRepository $repository
     * @param LubrificationTypeValidator $validator
     */
    public function __construct(LubrificationTypeRepository $repository, LubrificationTypeValidator $validator)
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
        $lubrificationTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $lubrificationTypes,
            ]);
        }

        return view('lubrificationTypes.index', compact('lubrificationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LubrificationTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LubrificationTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $lubrificationType = $this->repository->create($request->all());

            $response = [
                'message' => 'LubrificationType created.',
                'data'    => $lubrificationType->toArray(),
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
        $lubrificationType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $lubrificationType,
            ]);
        }

        return view('lubrificationTypes.show', compact('lubrificationType'));
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
        $lubrificationType = $this->repository->find($id);

        return view('lubrificationTypes.edit', compact('lubrificationType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LubrificationTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LubrificationTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $lubrificationType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'LubrificationType updated.',
                'data'    => $lubrificationType->toArray(),
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
                'message' => 'LubrificationType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'LubrificationType deleted.');
    }
}

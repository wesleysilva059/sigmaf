<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LubrificationCreateRequest;
use App\Http\Requests\LubrificationUpdateRequest;
use App\Repositories\LubrificationRepository;
use App\Validators\LubrificationValidator;

/**
 * Class LubrificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class LubrificationsController extends Controller
{
    /**
     * @var LubrificationRepository
     */
    protected $repository;

    /**
     * @var LubrificationValidator
     */
    protected $validator;

    /**
     * LubrificationsController constructor.
     *
     * @param LubrificationRepository $repository
     * @param LubrificationValidator $validator
     */
    public function __construct(LubrificationRepository $repository, LubrificationValidator $validator)
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
        $lubrifications = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $lubrifications,
            ]);
        }

        return view('lubrifications.index', compact('lubrifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LubrificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LubrificationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $lubrification = $this->repository->create($request->all());

            $response = [
                'message' => 'Lubrification created.',
                'data'    => $lubrification->toArray(),
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
        $lubrification = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $lubrification,
            ]);
        }

        return view('lubrifications.show', compact('lubrification'));
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
        $lubrification = $this->repository->find($id);

        return view('lubrifications.edit', compact('lubrification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LubrificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LubrificationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $lubrification = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Lubrification updated.',
                'data'    => $lubrification->toArray(),
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
                'message' => 'Lubrification deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Lubrification deleted.');
    }
}

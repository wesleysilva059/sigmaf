<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MaintenanceStatusCreateRequest;
use App\Http\Requests\MaintenanceStatusUpdateRequest;
use App\Repositories\MaintenanceStatusRepository;
use App\Validators\MaintenanceStatusValidator;

/**
 * Class MaintenanceStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MaintenanceStatusesController extends Controller
{
    /**
     * @var MaintenanceStatusRepository
     */
    protected $repository;

    /**
     * @var MaintenanceStatusValidator
     */
    protected $validator;

    /**
     * MaintenanceStatusesController constructor.
     *
     * @param MaintenanceStatusRepository $repository
     * @param MaintenanceStatusValidator $validator
     */
    public function __construct(MaintenanceStatusRepository $repository, MaintenanceStatusValidator $validator)
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
        $maintenanceStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenanceStatuses,
            ]);
        }

        return view('register.maintenanceStatuses.index', compact('maintenanceStatuses'));
    }

    public function create()
    {
        return view('register.maintenanceStatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MaintenanceStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MaintenanceStatusCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $maintenanceStatus = $this->repository->create($request->all());

            $response = [
                'message' => 'MaintenanceStatus created.',
                'data'    => $maintenanceStatus->toArray(),
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
        $maintenanceStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenanceStatus,
            ]);
        }

        return view('maintenanceStatuses.show', compact('maintenanceStatus'));
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
        $maintenanceStatus = $this->repository->find($id);

        return view('maintenanceStatuses.edit', compact('maintenanceStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MaintenanceStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MaintenanceStatusUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $maintenanceStatus = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MaintenanceStatus updated.',
                'data'    => $maintenanceStatus->toArray(),
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
                'message' => 'MaintenanceStatus deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MaintenanceStatus deleted.');
    }
}

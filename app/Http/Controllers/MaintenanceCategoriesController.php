<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MaintenanceCategoryCreateRequest;
use App\Http\Requests\MaintenanceCategoryUpdateRequest;
use App\Repositories\MaintenanceCategoryRepository;
use App\Validators\MaintenanceCategoryValidator;

/**
 * Class MaintenanceCategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MaintenanceCategoriesController extends Controller
{
    /**
     * @var MaintenanceCategoryRepository
     */
    protected $repository;

    /**
     * @var MaintenanceCategoryValidator
     */
    protected $validator;

    /**
     * MaintenanceCategoriesController constructor.
     *
     * @param MaintenanceCategoryRepository $repository
     * @param MaintenanceCategoryValidator $validator
     */
    public function __construct(MaintenanceCategoryRepository $repository, MaintenanceCategoryValidator $validator)
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
        $maintenanceCategories = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenanceCategories,
            ]);
        }

        return view('register.maintenanceCategories.index', compact('maintenanceCategories'));
    }

    public function create()
    {
        return view('register.maintenanceCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MaintenanceCategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MaintenanceCategoryCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $maintenanceCategory = $this->repository->create($request->all());

            $response = [
                'message' => 'MaintenanceCategory created.',
                'data'    => $maintenanceCategory->toArray(),
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
        $maintenanceCategory = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maintenanceCategory,
            ]);
        }

        return view('maintenanceCategories.show', compact('maintenanceCategory'));
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
        $maintenanceCategory = $this->repository->find($id);

        return view('maintenanceCategories.edit', compact('maintenanceCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MaintenanceCategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MaintenanceCategoryUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $maintenanceCategory = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MaintenanceCategory updated.',
                'data'    => $maintenanceCategory->toArray(),
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
                'message' => 'MaintenanceCategory deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MaintenanceCategory deleted.');
    }
}

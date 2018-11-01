<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CostCenterCreateRequest;
use App\Http\Requests\CostCenterUpdateRequest;
use App\Repositories\CostCenterRepository;
use App\Validators\CostCenterValidator;

/**
 * Class CostCentersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CostCentersController extends Controller
{
    /**
     * @var CostCenterRepository
     */
    protected $repository;

    /**
     * @var CostCenterValidator
     */
    protected $validator;

    /**
     * CostCentersController constructor.
     *
     * @param CostCenterRepository $repository
     * @param CostCenterValidator $validator
     */
    public function __construct(CostCenterRepository $repository, CostCenterValidator $validator)
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
        $costCenters = $this->repository->all();

        return view('register.costCenters.index', compact('costCenters'));
    }

    public function create()
    {
        return view('register.costCenters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CostCenterCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CostCenterCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $costCenter = $this->repository->create($request->all());

            $response = [
                'message' => 'CostCenter created.',
                'data'    => $costCenter->toArray(),
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
        $costCenter = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $costCenter,
            ]);
        }

        return view('costCenters.show', compact('costCenter'));
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
        $costCenter = $this->repository->find($id);

        return view('costCenters.edit', compact('costCenter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CostCenterUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CostCenterUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $costCenter = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CostCenter updated.',
                'data'    => $costCenter->toArray(),
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

        return redirect()->back()->with('message', 'CostCenter deleted.');
    }
}

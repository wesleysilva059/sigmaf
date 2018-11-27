<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InsuranceCreateRequest;
use App\Http\Requests\InsuranceUpdateRequest;
use App\Repositories\InsuranceRepository;
use App\Validators\InsuranceValidator;

/**
 * Class InsurancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InsurancesController extends Controller
{
    /**
     * @var InsuranceRepository
     */
    protected $repository;

    /**
     * @var InsuranceValidator
     */
    protected $validator;

    /**
     * InsurancesController constructor.
     *
     * @param InsuranceRepository $repository
     * @param InsuranceValidator $validator
     */
    public function __construct(InsuranceRepository $repository, InsuranceValidator $validator)
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
        $insurances = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $insurances,
            ]);
        }

        return view('insurances.index', compact('insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InsuranceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InsuranceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $insurance = $this->repository->create($request->all());

            $response = [
                'message' => 'Insurance created.',
                'data'    => $insurance->toArray(),
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
        $insurance = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $insurance,
            ]);
        }

        return view('insurances.show', compact('insurance'));
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
        $insurance = $this->repository->find($id);

        return view('insurances.edit', compact('insurance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InsuranceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InsuranceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $insurance = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Insurance updated.',
                'data'    => $insurance->toArray(),
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
                'message' => 'Insurance deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Insurance deleted.');
    }
}

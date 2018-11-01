<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FilterChangeTypeCreateRequest;
use App\Http\Requests\FilterChangeTypeUpdateRequest;
use App\Repositories\FilterChangeTypeRepository;
use App\Validators\FilterChangeTypeValidator;

/**
 * Class FilterChangeTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class FilterChangeTypesController extends Controller
{
    /**
     * @var FilterChangeTypeRepository
     */
    protected $repository;

    /**
     * @var FilterChangeTypeValidator
     */
    protected $validator;

    /**
     * FilterChangeTypesController constructor.
     *
     * @param FilterChangeTypeRepository $repository
     * @param FilterChangeTypeValidator $validator
     */
    public function __construct(FilterChangeTypeRepository $repository, FilterChangeTypeValidator $validator)
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
        $filterChangeTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChangeTypes,
            ]);
        }

        return view('register.filterChangeTypes.index', compact('filterChangeTypes'));
    }

    public function create()
    {
        return view('register.filterChangeTypes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  FilterChangeTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FilterChangeTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $filterChangeType = $this->repository->create($request->all());

            $response = [
                'message' => 'FilterChangeType created.',
                'data'    => $filterChangeType->toArray(),
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
        $filterChangeType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChangeType,
            ]);
        }

        return view('filterChangeTypes.show', compact('filterChangeType'));
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
        $filterChangeType = $this->repository->find($id);

        return view('filterChangeTypes.edit', compact('filterChangeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FilterChangeTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FilterChangeTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $filterChangeType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'FilterChangeType updated.',
                'data'    => $filterChangeType->toArray(),
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
                'message' => 'FilterChangeType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FilterChangeType deleted.');
    }
}

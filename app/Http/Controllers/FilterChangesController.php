<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FilterChangeCreateRequest;
use App\Http\Requests\FilterChangeUpdateRequest;
use App\Repositories\FilterChangeRepository;
use App\Validators\FilterChangeValidator;

/**
 * Class FilterChangesController.
 *
 * @package namespace App\Http\Controllers;
 */
class FilterChangesController extends Controller
{
    /**
     * @var FilterChangeRepository
     */
    protected $repository;

    /**
     * @var FilterChangeValidator
     */
    protected $validator;

    /**
     * FilterChangesController constructor.
     *
     * @param FilterChangeRepository $repository
     * @param FilterChangeValidator $validator
     */
    public function __construct(FilterChangeRepository $repository, FilterChangeValidator $validator)
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
        $filterChanges = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChanges,
            ]);
        }

        return view('filterChanges.index', compact('filterChanges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FilterChangeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FilterChangeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $filterChange = $this->repository->create($request->all());

            $response = [
                'message' => 'FilterChange created.',
                'data'    => $filterChange->toArray(),
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
        $filterChange = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $filterChange,
            ]);
        }

        return view('filterChanges.show', compact('filterChange'));
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
        $filterChange = $this->repository->find($id);

        return view('filterChanges.edit', compact('filterChange'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FilterChangeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FilterChangeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $filterChange = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'FilterChange updated.',
                'data'    => $filterChange->toArray(),
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
                'message' => 'FilterChange deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FilterChange deleted.');
    }
}

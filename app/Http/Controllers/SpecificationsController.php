<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SpecificationCreateRequest;
use App\Http\Requests\SpecificationUpdateRequest;
use App\Repositories\SpecificationRepository;
use App\Validators\SpecificationValidator;

/**
 * Class SpecificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SpecificationsController extends Controller
{
    /**
     * @var SpecificationRepository
     */
    protected $repository;

    /**
     * @var SpecificationValidator
     */
    protected $validator;

    /**
     * SpecificationsController constructor.
     *
     * @param SpecificationRepository $repository
     * @param SpecificationValidator $validator
     */
    public function __construct(SpecificationRepository $repository, SpecificationValidator $validator)
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
        $specifications = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $specifications,
            ]);
        }

        return view('specifications.index', compact('specifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SpecificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SpecificationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $specification = $this->repository->create($request->all());

            $response = [
                'message' => 'Specification created.',
                'data'    => $specification->toArray(),
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
        $specification = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $specification,
            ]);
        }

        return view('specifications.show', compact('specification'));
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
        $specification = $this->repository->find($id);

        return view('specifications.edit', compact('specification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SpecificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SpecificationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $specification = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Specification updated.',
                'data'    => $specification->toArray(),
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
                'message' => 'Specification deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Specification deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MakeCreateRequest;
use App\Http\Requests\MakeUpdateRequest;
use App\Repositories\MakeRepository;
use App\Validators\MakeValidator;

/**
 * Class MarksController.
 *
 * @package namespace App\Http\Controllers;
 */
class MakesController extends Controller
{
    /**
     * @var MarkRepository
     */
    protected $repository;

    /**
     * @var MarkValidator
     */
    protected $validator;

    /**
     * MarksController constructor.
     *
     * @param MarkRepository $repository
     * @param MarkValidator $validator
     */
    public function __construct(MakeRepository $repository, MakeValidator $validator)
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
        $makes = $this->repository->all();

        return view('register.makes.index', compact('makes'));
    }

    public function create()
    {
        return view('register.makes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  makeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MakeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $make = $this->repository->create($request->all());

            $response = [
                'message' => 'make created.',
                'data'    => $make->toArray(),
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
        $make = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $make,
            ]);
        }

        return view('makes.show', compact('make'));
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
        $make = $this->repository->find($id);

        return view('makes.edit', compact('make'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  makeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MakeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $make = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'make updated.',
                'data'    => $make->toArray(),
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
                'message' => 'Make deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Make deleted.');
    }
}

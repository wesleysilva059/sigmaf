<?php

namespace App\Http\Controllers;

use App\Entities\City;
use App\Entities\State;
use App\Http\Requests;
use App\Http\Requests\ProviderCreateRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Repositories\ProviderRepository;
use App\Validators\ProviderValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProvidersController extends Controller
{
    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * @var ProviderValidator
     */
    protected $validator;

    /**
     * ProvidersController constructor.
     *
     * @param ProviderRepository $repository
     * @param ProviderValidator $validator
     */
    public function __construct(ProviderRepository $repository, ProviderValidator $validator)
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
        $providers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $providers,
            ]);
        }

        return view('register.providers.index', compact('providers'));
    }

    public function create()
    {
        $state_list = State::all();

        return view('register.providers.create', compact('state_list'));
    }

    public function getCities($state_id)
    {
        $cities = City::all()->where('state_id',$state_id);
        sleep(1);
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProviderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProviderCreateRequest $request)
    {
       
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $provider = $this->repository->create($request->except('state'));

            $response = [
                'message' => 'Provider created.',
                'data'    => $provider->toArray(),
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
        $provider = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $provider,
            ]);
        }

        return view('providers.show', compact('provider'));
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
        $provider = $this->repository->find($id);

        return view('providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProviderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProviderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $provider = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Provider updated.',
                'data'    => $provider->toArray(),
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
                'message' => 'Provider deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Provider deleted.');
    }
}

<?php 

namespace App\Services;

use App\Repositories\VehicleRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\VehicleValidator;

class VehicleService
{
	protected $repository;
	protected $validator;

	public function __construct(VehicleRepository $repository, VehicleValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
}
<?php 

namespace App\Services;

use App\Repositories\DepartmentRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\DepartmentValidator;

class DepartmentService
{
	protected $repository;
	protected $validator;

	public function __construct(DepartmentRepository $repository, DepartmentValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
}


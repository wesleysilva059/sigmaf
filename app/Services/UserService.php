<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\UserValidator;

class UserService
{
	protected $repository;
	protected $validator;

	public function __construct(UserRepository $repository, UserValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}
}
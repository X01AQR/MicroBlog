<?php
namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller {

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function all()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

}

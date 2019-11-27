<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $usersRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->usersRepository =  $userRepositoryInterface;
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ]);
    }

    public function register(Request $request)
    {
        $validatedRequest = $this->validator($request);

        return $this->usersRepository->storeUser($validatedRequest) ?
            response(['message' => 'Registration successful'], 201) :
            response(['message' => 'Registration failed'], 401);

    }
}

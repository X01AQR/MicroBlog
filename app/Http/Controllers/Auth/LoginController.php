<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
           'email' => 'email|required',
           'password' => 'string|required'
        ]);
    }


    public function login(Request $request)
    {
        $validatedRequest = $this->validator($request);

        $user = $this->userRepository->findByEmail($validatedRequest['email']);
        if (!$user)
            return response(['message' => 'Unauthorized'], 401);

        return $this->auth($user, $validatedRequest['password']);
    }

    private function auth($user, $password)
    {
        if (Hash::check($password, $user->password))
        {
            $apiToken = $this->userRepository->generateApiToken($user->id);

            return response(['api_token' => $apiToken], 201);
        } else
            return response(["message" => "Authentication failed"], 401);
    }

    public function logout()
    {
        return $this->userRepository->removeApiToken(Auth::user()->id) ?
            response(['message' => 'Logged out successfully'], 201) :
            response(['message' => 'Logged out failed'], 400);
    }




}

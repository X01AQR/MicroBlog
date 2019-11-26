<?php
namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller {

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function index()
    {
        # users not found (404)
        # users found (200)
        $users = $this->userRepository->all();
        if ($users == null)
            return response(['message' => 'No users found'], 404);

        return response($users, 200);
    }

    public function show($userId)
    {
        # non_positive_integer_input (422)
        # user_not_found (404)
        # user_found (200)
        try {
            Validator::make(['user_id' => $userId], ['user_id' => 'integer|min:1'])->validate();
        } catch (ValidationException $e) {
            return response(['message' => $e->getMessage()], 422);
        }

        $user = $this->userRepository->find($userId);

        if ($user == null)
            return response(['message' => 'User not found'], 404);

        return response($user, 200);
    }


    public function update(Request $request, $userId)
    {
        $validatedRequest = $this->validate($request,[
            'full_name' => 'required|string',
            'email' => 'required|email'
        ]);

        $this->userRepository->updateUser($validatedRequest, $userId);

    }

    public function destroy($userId)
    {
        $user = $this->userRepository->find($userId);
    }

}

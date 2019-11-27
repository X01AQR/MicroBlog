<?php
namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller {

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return count($users) >= 1 ? response($users, 200) :
            response(['messages' => "No users in blog"], 404);
    }

    public function show($userId)
    {
        $user = $this->userRepository->find($userId);

        return $user ? response($user, 200) : response(['message' => 'User not found'], 404);
    }


    public function update(Request $request, $userId)
    {
        $this->validator($request);

        return $this->userRepository->updateUser($request->toArray(), $userId) ?
            response(['message' => 'User updated successfully'], 201):
            response(['message' => 'User not found'], 404);
    }

    public function destroy($userId)
    {
        return $this->userRepository->deleteUser($userId) ?
            response(['message' => 'User deleted successfully'], 201):
            response(['message' => 'User not found'], 404);
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
            'full_name' => 'string|required',
            'email'     => 'email|required',
            'password'  => 'string|required',
        ]);

    }


}

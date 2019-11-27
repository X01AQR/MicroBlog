<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface {

    public function all()
    {
        $users = User::all();

        return $users;
    }


    public function find($userId)
    {
        $user = User::find($userId);

        return $user;
    }


    public function updateUser($validatedRequest, $userId)
    {
        $user = $this->find($userId);

        if($user)
            return $user->update($validatedRequest);
         else
            return null;
    }

    public function deleteUser($userId)
    {
        $user = $this->find($userId);
        if($user)
            return $user->delete();
         else
            return null;
    }
}

<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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

    public function findByEmail($email)
    {
        $user = User::where('email', '=', $email)->first();

        return $user ? $user : null;
    }

    public function storeUser($validatedRequest)
    {
        $user = User::create([
        'full_name' => $validatedRequest['full_name'],
        'email' => $validatedRequest['email'],
        'password' => app('hash')->make($validatedRequest['password'])
        ]);

        return $user ? $user : null;
    }


    public function updateUser($validatedRequest, $userId)
    {
        $user = $this->find($userId);

        if($user)
            return $user->update([
            'full_name' => $validatedRequest['full_name'],
            ]);
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

    public function generateApiToken($userId)
    {
        $user = $this->find($userId);
        $apiToken =  app('hash')->make($userId . ', ' . time());
        $user->update(['api_token' => $apiToken]);

        return $apiToken;
    }

    public function removeApiToken($userId)
        {
            $user = $this->find($userId);

            return $user->update(['api_token' => null]);
        }
}

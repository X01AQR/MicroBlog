<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface {

    public function all()
    {
        return User::all();
    }

    public function find($userId)
    {

    }
}

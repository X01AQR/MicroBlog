<?php


namespace App\Polices;


use App\User;

class UserPolicy
{
    public function update(User $user, User $updatedUser)
    {
        return $user->id === $updatedUser->id;
    }

    public function delete(User $user, User $updatedUser)
    {
        return $user->id === $updatedUser->id;
    }
}

<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface {

    public function all();
    public function find($userId);
    public function updateUser($validatedRequest, $userId);
}

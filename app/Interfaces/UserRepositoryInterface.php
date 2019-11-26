<?php
namespace App\Interfaces;


interface UserRepositoryInterface {

    public function all();
    public function updateUser($validatedRequest, $userId);
    public function deleteUser($userId);
    public function find($userId);

}

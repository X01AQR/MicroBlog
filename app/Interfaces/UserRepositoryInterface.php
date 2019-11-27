<?php
namespace App\Interfaces;


interface UserRepositoryInterface {

    public function all();
    public function storeUser($validatedRequest);
    public function findByEmail($email);
    public function updateUser($validatedRequest, $userId);
    public function deleteUser($userId);
    public function find($userId);
    public function generateApiToken($userId);
    public function removeApiToken($userId);

}

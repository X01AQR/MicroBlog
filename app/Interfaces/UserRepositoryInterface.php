<?php
namespace App\Interfaces;

interface UserRepositoryInterface {

    public function all();
    public function find($userId);
}

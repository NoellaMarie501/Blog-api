<?php

namespace App\Services;

interface UserServiceInterface
{
    public function registerUser(array $data);

    public function loginUser(array $credentials);

    public function updatePassword(int $userId, array $data);

    public function getUserRecord(int $userId);

    public function logOutUser($user);
}

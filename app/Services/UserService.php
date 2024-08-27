<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function loginUser(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = $this->userRepository->findEmail($credentials['email']);
            return $user->createToken('Laravel Personal Access Client')->accessToken;
        }

        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }

    public function updatePassword(int $userId, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($userId, $data);
    }

    public function getUserRecord(int $userId)
    {
        return $this->userRepository->find($userId);
    }

    public function logOutUser($user)
    {
        foreach ($user->tokens as $token) {
            $token->revoke();
        }
        return true;
    }

    public function getUserById(int $userId)
    {
        return $this->userRepository->find($userId);
    }
}

<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param string $email
     * @param string $password
     * @return array|string
     */
    public function login(string $email, string $password): array|string
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $token =  $user->createToken('app');

            return [
                'token' => $token->plainTextToken,
            ];
        }
        return [
            'error' => 'Unauthorized'
        ];
    }

    /**
     * @param array $userData
     * @return User
     */
    public function create(array $userData): User
    {
        return $this->userModel->create($userData);
    }

    public function show(string $uuid): User
    {
        return $this->userModel->where('id', $uuid)->with('role')->firstOrFail();
    }
}

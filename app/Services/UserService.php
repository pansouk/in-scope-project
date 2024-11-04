<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param array $data
     * @return array|string[]
     */
    public function login(string $email, string $password): array
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
}

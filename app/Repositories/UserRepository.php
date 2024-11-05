<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
            $token = $user->createToken('app');

            return [
                'token' => $token->plainTextToken,
            ];
        }
        return [
            'error' => 'Unauthorized'
        ];
    }

    /**
     * All Users
     * @param string $role
     * @return Collection|array|User
     */
    public function index(string $role = 'all'): Collection|array|User
    {
        return match ($role) {
            'admin' => $this->userModel->whereHas('role', function ($q) {
                $q->where('name', 'admin');
            })->with('role')->get(),
            'user' => $this->userModel->whereHas('role', function ($q) {
                $q->where('name', 'user');
            })->with('role')->get(),
            default => $this->userModel->with('role')->get(),
        };
    }

    /**
     * @param array $userData
     * @return User
     */
    public function create(array $userData): User
    {
        return $this->userModel->create($userData);
    }

    /**
     * Show a user
     * @param string $uuid
     * @return User
     */
    public function show(string $uuid): User
    {
        return $this->userModel->where('id', $uuid)->with('role')->firstOrFail();
    }

    /**
     * Update a user
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->userModel->where('id', $data['id'])->update($data);
    }

    /**
     * Delete a user
     * @param string $uuid
     * @return bool|null
     */
    public function delete(string $uuid): bool|null
    {
        return $this->userModel->where('id', $uuid)->delete();
    }
}

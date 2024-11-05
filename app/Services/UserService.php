<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected UserRepository $userRepository;
    protected RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return array|string[]
     */
    public function login(string $email, string $password): array
    {
        return $this->userRepository->login($email, $password);
    }

    /**
     * All users
     * @param string $role
     * @return Collection|User|array
     */
    public function index(string $role = 'all'): Collection|User|array
    {
        return $this->userRepository->index($role);
    }

    /**
     * Create a user
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $default_role = $this->roleRepository->theDefault();
        $data['role_id'] = $default_role->id;
        return $this->userRepository->create($data);
    }

    /**
     * Display a user
     * @param string $uuid
     * @return User
     */
    public function show(string $uuid): User
    {
        return $this->userRepository->show($uuid);
    }

    /**
     * Update a user
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->userRepository->update($data);
    }

    /**
     * Delete a user
     * @param string $uuid
     * @return bool|null
     */
    public function delete(string $uuid): bool|null
    {
        return $this->userRepository->delete($uuid);
    }
}

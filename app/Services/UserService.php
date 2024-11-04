<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

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

    public function create(array $data): User
    {
        $default_role = $this->roleRepository->theDefault();
        $data['role_id'] = $default_role->id;
        return $this->userRepository->create($data);
    }

    public function show(string $uuid): User
    {
        return $this->userRepository->show($uuid);
    }
}

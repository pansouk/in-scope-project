<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * The default role
     * @return mixed
     */
    public function theDefault(): mixed
    {
        return $this->role->where(['name' => 'user'])->first();
    }
}

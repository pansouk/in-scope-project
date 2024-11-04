<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected RoleRepository $repo;

    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return mixed
     */
    public function theDefault(): mixed
    {
        return $this->repo->theDefault();
    }
}

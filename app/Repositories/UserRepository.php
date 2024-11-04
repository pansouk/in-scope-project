<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
}

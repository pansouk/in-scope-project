<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
}

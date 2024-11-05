<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function index(string $type = 'all'): Collection
    {
        return $this->projectRepository->index($type);
    }

}

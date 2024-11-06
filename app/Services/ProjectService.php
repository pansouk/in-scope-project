<?php

namespace App\Services;

use App\Models\Projects\Complex;
use App\Models\Projects\Standard;
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
     * Display projects
     * @param string $type
     * @return Collection
     */
    public function index(string $type = 'all'): Collection
    {
        return $this->projectRepository->index($type);
    }

    /**
     * Create a project
     * @param array $data
     * @return Standard|Complex|null
     */
    public function create(array $data): Standard|Complex|null
    {
        return $this->projectRepository->create($data);
    }

    /**
     * Show a project
     * @param string $uuid
     * @param string $type
     * @return Standard|Complex|null
     */
    public function show(string $uuid, string $type): Standard|Complex|null
    {
        return $this->projectRepository->show($uuid, $type);
    }

    /**
     * Update a project
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->projectRepository->update($data);
    }

    /**
     * Delete a project
     * @param string $uuid
     * @param string $type
     * @return bool
     */
    public function delete(string $uuid, string $type): bool
    {
        return $this->projectRepository->delete($uuid, $type);
    }

}

<?php

namespace App\Repositories;

use App\Models\Projects\Complex;
use App\Models\Projects\Standard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository
{
    protected Standard $standardModel;
    protected Complex $complexModel;

    public function __construct(Standard $standardModel, Complex $complexModel)
    {
        $this->standardModel = $standardModel;
        $this->complexModel = $complexModel;
    }

    /**
     * Display projects
     * @param string $type
     * @return Collection
     */
    public  function index(string $type = 'all'): Collection
    {
        $standards = $this->standardModel->with('company')->get();
        $complexes = $this->complexModel->with('company')->get();
        $union = $standards->union($complexes);
        return match($type){
            'standard' => $standards,
            'complex' => $complexes,
            default => $union,
        };
    }

    /**
     * Create a project
     * @param array $data
     * @return Standard|Complex|null
     */
    public function create(array $data): Standard|Complex|null
    {
        return match($data["type"]){
            'standard' => $this->standardModel->create($data),
            'complex' => $this->complexModel->create($data),
            default => null,
        };
    }

    /**
     * Show a project
     * @param string $uuid
     * @param string $type
     * @return Standard|Complex|null
     */
    public function show(string $uuid, string $type): Standard|Complex|null
    {
        return match($type){
            'standard' => $this->standardModel->where('id', $uuid)->firstOrFail(),
            'complex' => $this->complexModel->where('id', $uuid)->firstOrFail(),
            default => null,
        };
    }

    /**
     * Update a project
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return match($data["type"]){
            'standard' => $this->standardModel->where('id', $data['id'])->update($data),
            'complex' => $this->complexModel->where('id', $data['id'])->update($data),
            default => false,
        };
    }

    /**
     * Delete a project
     * @param string $uuid
     * @param string $type
     * @return bool
     */
    public function delete(string $uuid, string $type): bool
    {
        return match($type){
            'standard' => $this->standardModel->where('id', $uuid)->delete(),
            'complex' => $this->complexModel->where('id', $uuid)->delete(),
            default => false,
        };
    }
}

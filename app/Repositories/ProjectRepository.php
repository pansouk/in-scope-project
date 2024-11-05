<?php

namespace App\Repositories;

use App\Models\Projects\Complex;
use App\Models\Projects\Standard;
use Illuminate\Database\Eloquent\Collection;

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
}

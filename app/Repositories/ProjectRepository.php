<?php

namespace App\Repositories;

use App\Models\Projects\Complex;
use App\Models\Projects\Standard;

class ProjectRepository
{
    protected Standard $standardModel;
    protected Complex $complexModel;

    public function __construct(Standard $standardModel, Complex $complexModel)
    {
        $this->standardModel = $standardModel;
        $this->complexModel = $complexModel;
    }
}

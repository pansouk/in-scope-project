<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Project extends Model
{
    use HasUuids, HasFactory;
    protected $table = 'projects';
    protected $keyType = 'string';
}

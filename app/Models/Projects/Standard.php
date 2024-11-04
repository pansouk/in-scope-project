<?php

namespace App\Models\Projects;



use Illuminate\Database\Eloquent\Factories\HasFactory;

class Standard extends Project
{
    use HasFactory;
    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', Type::STANDARD);
        });

        static::creating(function (Project $project) {
            $project->type = Type::STANDARD;
        });
    }
}

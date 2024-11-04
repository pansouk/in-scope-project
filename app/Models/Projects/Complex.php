<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property double $budget
 * @property $timeline
 */
class Complex extends Project
{
    use HasFactory;

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', TYPE::COMPLEX);
        });

        static::creating(function (Project $project) {
            $project->type = Type::COMPLEX;
        });
    }
}

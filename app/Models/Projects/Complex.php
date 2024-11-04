<?php

namespace App\Models\Projects;

use App\Models\Company;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}

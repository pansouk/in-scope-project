<?php

namespace App\Models\Projects;



use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}

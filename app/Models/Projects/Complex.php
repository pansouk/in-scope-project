<?php

namespace App\Models\Projects;


use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property double $budget
 * @property $timeline
 */
class Complex extends Project
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'budget', 'timeline'];

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
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

<?php

namespace App\Models;

use App\Models\Projects\Complex;
use App\Models\Projects\Standard;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_companies',
            'company_id',
            'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function complexProjects(): BelongsTo
    {
        return $this->belongsTo(Complex::class, 'id', 'company_id');
    }

    public function standardProjects(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'id', 'company_id');
    }
}

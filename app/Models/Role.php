<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasUuids, HasFactory;
    protected $keyType = 'string';
    protected $guarded = [];

    /**
     * Relation with users (has many)
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

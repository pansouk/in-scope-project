<?php

namespace App\Models\Sanctum;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\PersonalAccessToken as BasePersonalAccessToken;

class PersonalAccessToken extends BasePersonalAccessToken
{
    use HasUuids;

    protected $keyType = 'string';
}

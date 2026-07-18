<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'phone',
        'email',
        'address',
        'company_name',
        'company_address',
        'website_url',
        'facebook_link',
        'x_link',
        'instagram_link',
        'linkedin_link',
        'status',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_status_id',
        'client_id',
        'unique_code',
        'name',
        'slug',
        'description',
        'project_thumbnail',
        'project_document',
        'start_date',
        'end_date',
        'followup_date',
        'technology',
        'key_features',
        'tags',
        'team_ids',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'technology' => 'array',
        'key_features' => 'array',
        'tags' => 'array',
        'team_ids' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'followup_date' => 'date',
    ];

    public function projectStatus(): BelongsTo
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ProjectGallery::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getAssigneesAttribute()
    {
        return User::query()->whereIn('id', $this->team_ids ?? [])->get();
    }
}

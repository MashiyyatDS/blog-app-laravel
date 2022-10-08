<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $attributes = [
        'image' => 'none'
    ];

    protected $casts = [
        'created_at' => 'date: M d, Y - H:i A'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->slug = 'project-' . rand() . $project->id . time();
        });
    }

    public function tags()
    {
        return $this->hasMany(ProjectTag::class, 'project_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }
}

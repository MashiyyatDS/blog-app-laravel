<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use function PHPSTORM_META\map;

class ProjectTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'project_id',
        'slug'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($project) {
            $project->slug = 'project-tag-'.rand().$project->id.time();
        });
    }
}

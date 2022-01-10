<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'repository',
        'image',
        'slug',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'date: M d, Y - H:i A'
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($project) {
            $project->slug = 'project-'.rand().$project->id.time();
        });
    }

    public function tags()
    {
        return $this->hasMany(ProjectTag::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

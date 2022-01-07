<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'slug',
        'blog_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($tag) {
            $tag->slug = 'tag-'.rand().$tag->id.time();
        });
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}

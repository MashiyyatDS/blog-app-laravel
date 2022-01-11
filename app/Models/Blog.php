<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'isNsfw',
        'category',
        'user_id',
        'slug'
    ];

    protected $attributes = [
        'isNsfw' => false
    ];

    protected $casts = [
        'created_at' => 'date: M d, Y - H:i A'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($blog) {
            $blog->slug = 'blog-'.rand().$blog->id.time();
        });
    }

    public function tags()
    {
        return $this->hasMany(Tags::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}

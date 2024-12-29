<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_title',
        'content',
        'media_title',
        'author_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($blog){
            $blog->author_id = Auth::id();
        });

    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media_id',
        'file_id',
        'author_id',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function file()
    {
        return $this->belongsTo(Files::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($newsletter){
            $newsletter->author_id = Auth::id();
        });

        static::saving(function ($model) {
            if($model->media_id && $model->file_id) {
                throw new \Exception("La newsletter ne peut être lié qu'à une seul modèle: Média ou File", Response::HTTP_BAD_REQUEST);
            }
        });

        static::updating( function($newsletter){
            if(Auth::check()) {
                $newsletter->editors()->syncWithoutDetaching([Auth::id()]);
            }
        });

    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editors()
    {
        return $this->belongsTo(User::class, 'newsletter_editors', 'newsletter_id', 'user_id');
    }
}

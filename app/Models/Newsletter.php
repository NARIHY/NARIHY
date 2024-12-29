<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media_id',
        'file_id'
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

        static::saving(function ($model) {
            if($model->media_id && $model->file_id) {
                throw new \Exception("La newsletter ne peut être lié qu'à une seul modèle: Média ou File", Response::HTTP_BAD_REQUEST);
            }
        });

    }
}

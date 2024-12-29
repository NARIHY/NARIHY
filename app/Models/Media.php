<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Media extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name','media'
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile();  // Si vous voulez une seule image par collection, vous pouvez utiliser "singleFile()"
    }

    public function newsletters()
    {
        return $this->hasMany(Newsletter::class);
    }
}

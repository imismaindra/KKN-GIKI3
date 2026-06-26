<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}

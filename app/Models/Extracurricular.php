<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'pembina',
        'schedule',
        'icon',
        'image_path',
    ];
}

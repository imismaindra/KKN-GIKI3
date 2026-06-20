<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'icon',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUuids;

    protected $fillable = [
        'school_name',
        'logo',
        'address',
        'email',
        'phone',
        'vision',
        'mission',
        'facebook_url',
        'instagram_url',
        'youtube_url',
    ];
}

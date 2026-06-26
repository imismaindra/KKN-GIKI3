<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'button_text',
        'button_url',
        'order',
        'is_active',
        'is_default',
        'alignment',
        'cta_color',
        'overlay_opacity',
        'text_color',
    ];
}

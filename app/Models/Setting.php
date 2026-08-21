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
        'tiktok_url',
        'instagram_url',
        'youtube_url',
        'about_title',
        'about_description',
        'about_image',
        'about_year_founded',
        'about_accreditation',
        'about_card_title',
        'about_card_desc',
        'headmaster_name',
        'headmaster_title',
        'headmaster_photo',
        'headmaster_speech_title',
        'headmaster_speech',
        'maps_embed',
        'erapor_url',
        'ujian_url',
        'stat_students',
        'stat_teachers',
        'stat_achievements',
        'stat_years',
    ];
}
